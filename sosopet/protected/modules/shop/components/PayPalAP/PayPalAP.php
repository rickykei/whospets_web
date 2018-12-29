<?php

/*********************************************************
* PayPal Adaptive Payments PHP Class
* Author: Simon W. Henriksen
*
* Based on PayPal's own PHP examples

* This is a work in progress. 
* Some functionality still needs to be abstracted
**********************************************************/


class PayPalAP
{
	private static $__apiUsername;
	private static $__apiPassword;
	private static $__apiSignature;
	private static $__apiAppid;
	private static $__env;
	private static $__apiEndpoint;
	
	private static $__useProxy;
	private static $__proxyHost;
	private static $__proxyPort;
	
	/*********************************************
	* Public usage functions
	**********************************************/
	
	/**
	* Sets authentication information needed for Adaptive Payments functionality
	* @param string $apiUsername Your PayPal api username
	* @param string $apiPassword Your PayPal api password
	* @param string $apiSignature Your PayPal api signature
	* @param string $apiAppid PayPal app id. Only for live environtments.
	* @param string $env Set to 'sandbox' or leave default for testmode
	* @param string $useProxy Set to true if you want to use a proxy (CURL)
	* @param string $proxyHost The proxy host
	* @param string $proxyPort The proxy port
	* @return Nothing
	*/
	
	/**
     * Holds the last error encountered
     *
     * @var string
     */
    public $lastError;

    /**
     * Do we need to log IPN results ?
     *
     * @var boolean
     */
    public $logIpn;

    /**
     * File to log IPN results
     *
     * @var string
     */
    public $ipnLogFile;

    /**
     * Payment gateway IPN response
     *
     * @var string
     */
    public $ipnResponse;

    /**
     * Field array to submit to gateway
     *
     * @var array
     */
    public $fields = array();

    /**
     * IPN post values as array
     *
     * @var array
     */
    public $ipnData = array();
	private $request = '';
	
	/**
     * Initialization constructor
     *
     * @param none
     * @return void
     */
    public function __construct()
    {
        // Some default values of the class
        $this->lastError = '';
        $this->logIpn = TRUE;
        $this->ipnResponse = '';
		$this->ipnLogFile = 'paypal.ipn_results.log';
    }

	
	public static function setAuth($apiUsername, $apiPassword, $apiSignature, $apiAppid = 'APP-80W284485P519543T', $env = 'sandbox', $useProxy = false, $proxyHost = '', $proxyPort = '') {

		if($env == 'sandbox')
		{
			self::$__apiEndpoint = 'https://svcs.sandbox.paypal.com/AdaptivePayments';
		}
		else 
		{
			self::$__apiEndpoint = 'https://svcs.paypal.com/AdaptivePayments';
		}
		
		if(session_id() == '')
		{
			session_start();
		}
			
		self::$__apiUsername = $apiUsername;
		self::$__apiPassword = $apiPassword;
		self::$__apiSignature = $apiSignature;
		self::$__apiAppid = $apiAppid;
		self::$__env = $env;
		self::$__useProxy = $useProxy;
		self::$__proxyHost = $proxyHost;
		self::$__proxyPort = $proxyPort;
	}
	
	/**
	* Use to change environment. Must be called before using IPN-functionality
	* @param string $env Set to 'sandbox' or leave default for testmode.
	* @return Nothing
	*/
	
	public static function setEnv($env = 'sandbox') {
		if($env == 'sandbox')
		{
			self::$__apiEndpoint = 'https://svcs.sandbox.paypal.com/AdaptivePayments';
		}
		else 
		{
			self::$__apiEndpoint = 'https://svcs.paypal.com/AdaptivePayments';
		}
		
		self::$__env = $env;
	}

	/**
	* Setup pre-approval for payment(s). Remember to call setAuth before use.
	* 
	* @param array $options Array containing data needed to set up the pre-approval
	* @return 
	*	If succesful: redirect to paypal for approval 
	*	If unsuccessful: array with ['success'] = false and ['errors']
	*/
	public static function preApproval($options)
	{
		// Specifiy default values if user did not set them
		if(!isset($options['returnUrl'])) $options['returnUrl'] = '';
		if(!isset($options['cancelUrl'])) $options['cancelUrl'] = '';
		if(!isset($options['currencyCode'])) $options['currencyCode'] = '';
		if(!isset($options['startingDate'])) $options['startingDate'] = '';
		if(!isset($options['endingDate'])) $options['endingDate'] = '';
		if(!isset($options['maxTotalAmountOfAllPayments'])) $options['maxTotalAmountOfAllPayments'] = '';
		if(!isset($options['senderEmail'])) $options['senderEmail'] = '';
		if(!isset($options['maxNumberOfPayments'])) $options['maxNumberOfPayments'] = '';
		if(!isset($options['paymentPeriod'])) $options['paymentPeriod'] = '';
		if(!isset($options['dateOfMonth'])) $options['dateOfMonth'] = '';
		if(!isset($options['dayOfWeek'])) $options['dayOfWeek'] = '';
		if(!isset($options['maxAmountPerPayment'])) $options['maxAmountPerPayment'] = '';
		if(!isset($options['maxNumberOfPaymentsPerPeriod'])) $options['maxNumberOfPaymentsPerPeriod'] = '';
		if(!isset($options['pinType'])) $options['pinType'] = '';
		
		$resArray = self::CallPreapproval($options['returnUrl'], $options['cancelUrl'], $options['currencyCode'], $options['startingDate'], $options['endingDate'], $options['maxTotalAmountOfAllPayments'], $options['senderEmail'], $options['maxNumberOfPayments'], $options['paymentPeriod'], $options['dateOfMonth'], $options['dayOfWeek'], $options['maxAmountPerPayment'], $options['maxNumberOfPaymentsPerPeriod'], $options['pinType']);

		$ack = strtoupper($resArray["responseEnvelope.ack"]);
		if($ack=="SUCCESS")
		{
			$cmd = "cmd=_ap-preapproval&preapprovalkey=" . urldecode($resArray["preapprovalKey"]);
			self::RedirectToPayPal ( $cmd );
		} 
		else  
		{
			return array('success' => false, 'errors' => self::generateErrorArray($resArray));
		}
	}
	
	public static function doExecutePayment($options)
	{
		if(!isset($options['payKey'])) $options['payKey']='';
		$resArray = self::CallExecutePayment($options['payKey']);
		$ack = strtoupper($resArray["responseEnvelope.ack"]);
		if($ack=="SUCCESS")
		{
			// redirect for web approval flow
			$cmd = "cmd=_ap-payment&paykey=" . urldecode($resArray["payKey"]);
			self::RedirectToPayPal ( $cmd );
		} 
		else  
		{
			return array('success' => false, 'errors' => self::generateErrorArray($resArray));
		}
	}
	
	public static function doSetPaymentOptions($options)
	{
		// Specifiy default values if user did not set them
		if(!isset($options['payKey'])) $options['payKey']='';
		if(!isset($options['displayName'])) $options['displayName']='Test';
		if(!isset($options['email'])) $options['email']='Test@abc.com';
		if(!isset($options['firstName'])) $options['firstName']='jc';
		if(!isset($options['institutionCustomerId'])) $options['institutionCustomerId']='1';
		if(!isset($options['institutionId'])) $options['institutionId']='';
		if(!isset($options['lastName'])) $options['lastName']='test';
		if(!isset($options['addresseeName'])) $options['addresseeName']='Kickzmall Customer';
		if(!isset($options['street1'])) $options['street1']='street 1';
		if(!isset($options['street2'])) $options['street2']='street 2';
		if(!isset($options['city'])) $options['city']='Hong Kong';
		if(!isset($options['state'])) $options['state']='Hong Kong';
		if(!isset($options['zip'])) $options['zip']='852';
		if(!isset($options['country'])) $options['country']='China';
		if(!isset($options['receiverEmail'])) $options['receiverEmail']=''; 
		if(!isset($options['itemNameArray'])) $options['itemNameArray']=array();
		if(!isset($options['itemPriceArray'])) $options['itemPriceArray']=array();
		if(!isset($options['itemItemPriceArray'])) $options['itemItemPriceArray']=array();
		if(!isset($options['itemItemCountArray'])) $options['itemItemCountArray']=array();
		if(!isset($options['totalShipping'])) $options['totalShipping']=0;
		
		$resArray = self::CallSetPaymentOptions($options['payKey'], 
												$options['displayName'],
												$options['email'], 
												$options['firstName'], 
												$options['institutionCustomerId'], 
												$options['institutionId'], 
												$options['lastName'], 
												$options['addresseeName'], 
												$options['street1'], 
												$options['street2'], 
												$options['city'], 
												$options['state'],	
												$options['zip'], 
												$options['country'], 
												$options['receiverEmail'], 
												$options['itemNameArray'],
												$options['itemPriceArray'],
												$options['itemItemPriceArray'],
												$options['itemItemCountArray'],
												$options['totalShipping']
												);
		
		$ack = strtoupper($resArray["responseEnvelope.ack"]);
		//echo Yii::trace(CVarDumper::dumpAsString($resArray),'vardump');
		if($ack=="SUCCESS")
		{
			$cmd = "cmd=_ap-payment&paykey=" . $options['payKey'];
			//self::RedirectToPayPal ( $cmd );
			self::RedirectToPayPalFlow($cmd);
			return array(
				'success' => true, 
				'details' => array(
					//'payKey' => $payKey,
					//'paymentExecStatus' => $paymentExecStatus
				)
			);
		} 
		else  
		{
			return array('success' => false, 'errors' => self::generateErrorArray($resArray));
		}
	}
	
	/**
	* Do a payment. Can be preapproved or not. Remember to call setAuth before use.
	* 
	* @param array $options Array containing data needed to perfom the payment
	* @return 
	*	If not preapproved: redirect to paypal for approval/payment
	*	If prapproved and successful: array with ['success'] = true and ['details'] about the payment
	*	If unsuccessful: array with ['success'] = false and ['errors']
	*/
	public static function doPayment($options)
	{
		// Specifiy default values if user did not set them
		if(!isset($options['cancelUrl'])) $options['cancelUrl'] = 'https://NoOp';
		if(!isset($options['returnUrl'])) $options['returnUrl'] = 'https://NoOp';
		if(!isset($options['senderEmail'])) $options['senderEmail'] = '';
		if(!isset($options['currencyCode'])) $options['currencyCode'] = '';
		if(!isset($options['receiverEmailArray'])) $options['receiverEmailArray'] = array('');
		if(!isset($options['receiverAmountArray'])) $options['receiverAmountArray'] = array('');
		if(!isset($options['receiverPrimaryArray'])) $options['receiverPrimaryArray'] = array('');
		if(!isset($options['receiverInvoiceIdArray'])) $options['receiverInvoiceIdArray'] = array('');
		if(!isset($options['feesPayer'])) $options['feesPayer'] = '';
		if(!isset($options['ipnNotificationUrl'])) $options['ipnNotificationUrl'] = '';
		if(!isset($options['memo'])) $options['memo'] = '';
		if(!isset($options['pin'])) $options['pin'] = '';
		if(!isset($options['preapprovalKey'])) $options['preapprovalKey'] = '';
		if(!isset($options['reverseAllParallelPaymentsOnError'])) $options['reverseAllParallelPaymentsOnError'] = '';
		
		
		// Set values users may not define for this transaction type
		if(!isset($options['actionType'])) $options['actionType'] = 'PAY';
		if(!isset($options['trackingId'])) $options['trackingId'] = self::generateTrackingID();
		
		$resArray = self::CallPay($options['actionType'], $options['cancelUrl'], $options['returnUrl'], $options['currencyCode'], $options['receiverEmailArray'], $options['receiverAmountArray'], $options['receiverPrimaryArray'], $options['receiverInvoiceIdArray'], $options['feesPayer'], $options['ipnNotificationUrl'], $options['memo'], $options['pin'], $options['preapprovalKey'],	$options['reverseAllParallelPaymentsOnError'], $options['senderEmail'], $options['trackingId']);
		
		$ack = strtoupper($resArray["responseEnvelope.ack"]);
		if($ack=="SUCCESS")
		{
			if ($options['preapprovalKey'] == "" && $options['actionType']!=='CREATE')
			{
				// redirect for web approval flow
				$cmd = "cmd=_ap-payment&paykey=" . urldecode($resArray["payKey"]);
				self::RedirectToPayPal ( $cmd );
			}
			else
			{
				// payKey is the key that you can use to identify the payment resulting from the Pay call
				$payKey = urldecode($resArray["payKey"]);
				// paymentExecStatus is the status of the payment
				$paymentExecStatus = urldecode($resArray["paymentExecStatus"]);
				return array(
					'success' => true, 
					'details' => array(
						'payKey' => $payKey,
						'paymentExecStatus' => $paymentExecStatus
					)
				);
			}
		} 
		else  
		{
			return array('success' => false, 'errors' => self::generateErrorArray($resArray));
		}
	}
	
	/**
	* Handle a received IPN. Remember to call setEnv before use.
	* 
	* @param array $data_array Array containing the data received from PayPal.
	* @return 
	*	If VERIFIED: true
	*	If UNVERIFIED: false
	*/
	public function handleIpn() {
		if (self::$__env == "sandbox") 
		{
			$payPalURL = "www.sandbox.paypal.com";
		}
		else
		{
			$payPalURL = "www.paypal.com";
		}
		
		$raw_post_data = file_get_contents('php://input');
		//$this->ipnData = $_POST;
		$raw_post_array = explode('&', $raw_post_data);
		$myPost = array();
		foreach ($raw_post_array as $keyval) {
		  $keyval = explode ('=', $keyval);
		  if (count($keyval) == 2)
			 $myPost[urldecode($keyval[0])] = urldecode($keyval[1]);
		}
		$this->ipnData = $myPost;
		// read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
		$this->request = 'cmd=_notify-validate';
		if(function_exists('get_magic_quotes_gpc')) {
		   $get_magic_quotes_exists = true;
		} 
		foreach ($myPost as $key => $value) {        
		   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
				$value = urlencode(stripslashes($value)); 
		   } else {
				$value = urlencode($value);
		   }
		   $this->request .= "&$key=$value";
		}
		
		// post back to PayPal system to validate
		$header = "";
		$header .= "POST /cgi-bin/webscr HTTP/1.1\r\n";
		$header .= "Host: $payPalURL\r\n";
		$header .= "Connection: close\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($this->request) . "\r\n\r\n";
		$fp = fsockopen ('ssl://'.$payPalURL, 443, $errno, $errstr, 30);

		if (!$fp) {
			// HTTP ERROR
			// Could not open the connection, log error if enabled
			$this->lastError = "fsockopen error no. $errno: $errstr";
			$this->logResults(false);

			return false;
		} else { 
			fwrite($fp, $header . $this->request);
			// loop through the response from the server and append to variable
			while(!feof($fp))
			{
				$this->ipnResponse .= fgets($fp, 1024);
			}

		 	fclose($fp); // close connection
		}
			
		//if (strpos("VERIFIED", $this->ipnResponse) !== false)
		if (strpos($this->ipnResponse, "VERIFIED") !== false)
		{
		 	// Valid IPN transaction.
		 	$this->logResults(true);
		 	return true;
		}
		else
		{
		 	// Invalid IPN transaction.  Check the log for details.
			$this->lastError = "IPN Validation Failed . $payPalURL"."\n\n";
			$this->logResults(false);
			return false;
		}
	}
	
	
	/*********************************************
	* Private functions. Most of them extracted from PayPal's PHP examples
	**********************************************/
	
	private static function callRefund($payKey, $transactionId, $trackingId, $receiverEmailArray, $receiverAmountArray)
	{
		/* Gather the information to make the Refund call.
			The variable nvpstr holds the name value pairs
		*/
		
		$nvpstr = "";
		
		// conditionally required fields
		if ("" != $payKey)
		{
			$nvpstr = "payKey=" . urlencode($payKey);
			if (0 != count($receiverEmailArray))
			{
				reset($receiverEmailArray);
				while (list($key, $value) = each($receiverEmailArray))
				{
					if ("" != $value)
					{
						$nvpstr .= "&receiverList.receiver(" . $key . ").email=" . urlencode($value);
					}
				}
			}
			if (0 != count($receiverAmountArray))
			{
				reset($receiverAmountArray);
				while (list($key, $value) = each($receiverAmountArray))
				{
					if ("" != $value)
					{
						$nvpstr .= "&receiverList.receiver(" . $key . ").amount=" . urlencode($value);
					}
				}
			}
		}
		elseif ("" != $trackingId)
		{
			$nvpstr = "trackingId=" . urlencode($trackingId);
			if (0 != count($receiverEmailArray))
			{
				reset($receiverEmailArray);
				while (list($key, $value) = each($receiverEmailArray))
				{
					if ("" != $value)
					{
						$nvpstr .= "&receiverList.receiver(" . $key . ").email=" . urlencode($value);
					}
				}
			}
			if (0 != count($receiverAmountArray))
			{
				reset($receiverAmountArray);
				while (list($key, $value) = each($receiverAmountArray))
				{
					if ("" != $value)
					{
						$nvpstr .= "&receiverList.receiver(" . $key . ").amount=" . urlencode($value);
					}
				}
			}
		}
		elseif ("" != $transactionId)
		{
			$nvpstr = "transactionId=" . urlencode($transactionId);
			// the caller should only have 1 entry in the email and amount arrays
			if (0 != count($receiverEmailArray))
			{
				reset($receiverEmailArray);
				while (list($key, $value) = each($receiverEmailArray))
				{
					if ("" != $value)
					{
						$nvpstr .= "&receiverList.receiver(" . $key . ").email=" . urlencode($value);
					}
				}
			}
			if (0 != count($receiverAmountArray))
			{
				reset($receiverAmountArray);
				while (list($key, $value) = each($receiverAmountArray))
				{
					if ("" != $value)
					{
						$nvpstr .= "&receiverList.receiver(" . $key . ").amount=" . urlencode($value);
					}
				}
			}
		}

		/* Make the Refund call to PayPal */
		$resArray = self::hash_call("Refund", $nvpstr);

		/* Return the response array */
		return $resArray;
	}
	
	private static function CallPaymentDetails($payKey, $transactionId, $trackingId)	
	{
		/* Gather the information to make the PaymentDetails call.
			The variable nvpstr holds the name value pairs
		*/
		
		$nvpstr = "";
		
		// conditionally required fields
		if ("" != $payKey)
		{
			$nvpstr = "payKey=" . urlencode($payKey);
		}
		elseif ("" != $transactionId)
		{
			$nvpstr = "transactionId=" . urlencode($transactionId);
		}
		elseif ("" != $trackingId)
		{
			$nvpstr = "trackingId=" . urlencode($trackingId);
		}

		/* Make the PaymentDetails call to PayPal */
		$resArray = self::hash_call("PaymentDetails", $nvpstr);

		/* Return the response array */
		return $resArray;
	}
	
	private static function CallPay($actionType, $cancelUrl, $returnUrl, $currencyCode, $receiverEmailArray, $receiverAmountArray, $receiverPrimaryArray, $receiverInvoiceIdArray, $feesPayer, $ipnNotificationUrl, $memo, $pin, $preapprovalKey, $reverseAllParallelPaymentsOnError, $senderEmail, $trackingId)
	{
		/* Gather the information to make the Pay call.
			The variable nvpstr holds the name value pairs
		*/
		
		// required fields
		$nvpstr = "actionType=" . urlencode($actionType) . "&currencyCode=" . urlencode($currencyCode);
		$nvpstr .= "&returnUrl=" . urlencode($returnUrl) . "&cancelUrl=" . urlencode($cancelUrl);

		if (0 != count($receiverAmountArray))
		{
			reset($receiverAmountArray);
			while (list($key, $value) = each($receiverAmountArray))
			{
				if ("" != $value)
				{
					$nvpstr .= "&receiverList.receiver(" . $key . ").amount=" . urlencode($value);
				}
			}
		}

		if (0 != count($receiverEmailArray))
		{
			reset($receiverEmailArray);
			while (list($key, $value) = each($receiverEmailArray))
			{
				if ("" != $value)
				{
					$nvpstr .= "&receiverList.receiver(" . $key . ").email=" . urlencode($value);
				}
			}
		}

		if (0 != count($receiverPrimaryArray))
		{
			reset($receiverPrimaryArray);
			while (list($key, $value) = each($receiverPrimaryArray))
			{
				if ("" != $value)
				{
					$nvpstr = $nvpstr . "&receiverList.receiver(" . $key . ").primary=" . urlencode($value);
				}
			}
		}

		if (0 != count($receiverInvoiceIdArray))
		{
			reset($receiverInvoiceIdArray);
			while (list($key, $value) = each($receiverInvoiceIdArray))
			{
				if ("" != $value)
				{
					$nvpstr = $nvpstr . "&receiverList.receiver(" . $key . ").invoiceId=" . urlencode($value);
				}
			}
		}
	
		// optional fields
		if ("" != $feesPayer)
		{
			$nvpstr .= "&feesPayer=" . urlencode($feesPayer);
		}

		if ("" != $ipnNotificationUrl)
		{
			$nvpstr .= "&ipnNotificationUrl=" . urlencode($ipnNotificationUrl);
		}

		if ("" != $memo)
		{
			$nvpstr .= "&memo=" . urlencode($memo);
		}

		if ("" != $pin)
		{
			$nvpstr .= "&pin=" . urlencode($pin);
		}

		if ("" != $preapprovalKey)
		{
			$nvpstr .= "&preapprovalKey=" . urlencode($preapprovalKey);
		}

		if ("" != $reverseAllParallelPaymentsOnError)
		{
			$nvpstr .= "&reverseAllParallelPaymentsOnError=" . urlencode($reverseAllParallelPaymentsOnError);
		}

		if ("" != $senderEmail)
		{
			$nvpstr .= "&senderEmail=" . urlencode($senderEmail);
		}

		if ("" != $trackingId)
		{
			$nvpstr .= "&trackingId=" . urlencode($trackingId);
		}

		/* Make the Pay call to PayPal */
		$resArray = self::hash_call("Pay", $nvpstr);

		/* Return the response array */
		return $resArray;
	}
	
	private static function CallExecutePayment($payKey)
	{
		/* Gather the information to make the Pay call.
			The variable nvpstr holds the name value pairs
		*/
		
		// required fields
		$nvpstr = "payKey=" . urlencode($payKey);
		
		/* Make the SetPaymentOptions call to PayPal */
		$resArray = self::hash_call("ExecutePayment", $nvpstr);

		/* Return the response array */
		return $resArray;
	}
	
	private static function CallSetPaymentOptions($payKey, $displayName, $email, $firstName, $institutionCustomerId, $institutionId, $lastName, $addresseeName, 
			$street1, $street2, $city, $state, $zip, $country, $receiverEmail, $itemNameArray, $itemPriceArray, $itemItemPriceArray, $itemItemCountArray, $totalShipping)
	{
		/* Gather the information to make the Pay call.
			The variable nvpstr holds the name value pairs
		*/
		
		// required fields
		$nvpstr = "payKey=" . urlencode($payKey);
		//$nvpstr .= "&displayName=" . urlencode($displayName);
		//$nvpstr .= "&email=" . urlencode($email) . "&firstName=" . urlencode($firstName);
		//$nvpstr .= "&institutionCustomerId=" . urlencode($institutionCustomerId) . "&institutionId=" . urlencode($institutionId);
		//$nvpstr .= "&lastName=" . urlencode($lastName) . "&addresseeName=" . urlencode($addresseeName);
		
		// shipping address
		$nvpstr .= "&senderOptions.requireShippingAddressSelection=true";
		if($addresseeName)
			$nvpstr .= "&senderOptions.shippingAddress.addresseeName=" . urlencode($addresseeName);
		if($street1)
			$nvpstr .= "&senderOptions.shippingAddress.street1=" . urlencode($street1);
		if($street2)
			$nvpstr .= "&senderOptions.shippingAddress.street2=" . urlencode($street2);
		if($city)
			$nvpstr .= "&senderOptions.shippingAddress.city=" . urlencode($city);
		if($state)
			$nvpstr .= "&senderOptions.shippingAddress.state=" . urlencode($state);
		//$nvpstr .= "&senderOptions.shippingAddress.zip=" . urlencode($zip) . "&senderOptions.shippingAddress.country=" . urlencode($country);
		if($country)
			$nvpstr .= "&senderOptions.shippingAddress.country=" . urlencode($country);
		
		$nvpstr .= "&receiverOptions(0).receiver.email=" . urlencode($receiverEmail) . "&receiverOptions(0).invoiceData.totalShipping=" . urlencode($totalShipping);
		
		if (0 != count($itemNameArray))
		{
			reset($itemNameArray);
			while (list($key, $value) = each($itemNameArray))
			{
				if ("" != $value)
				{
					$nvpstr .= "&receiverOptions(0).invoiceData.item(" . $key . ").name=" . urlencode($value);
				}
			}
		}
		if (0 != count($itemPriceArray))
		{
			reset($itemPriceArray);
			while (list($key, $value) = each($itemPriceArray))
			{
				if ("" != $value)
				{
					$nvpstr .= "&receiverOptions(0).invoiceData.item(" . $key . ").price=" . urlencode($value);
				}
			}
		}
		if (0 != count($itemItemPriceArray))
		{
			reset($itemItemPriceArray);
			while (list($key, $value) = each($itemItemPriceArray))
			{
				if ("" != $value)
				{
					$nvpstr .= "&receiverOptions(0).invoiceData.item(" . $key . ").itemPrice=" . urlencode($value);
				}
			}
		}
		if (0 != count($itemItemCountArray))
		{
			reset($itemItemCountArray);
			while (list($key, $value) = each($itemItemCountArray))
			{
				if ("" != $value)
				{
					$nvpstr .= "&receiverOptions(0).invoiceData.item(" . $key . ").itemCount=" . urlencode($value);
				}
			}
		}
												
		/* Make the SetPaymentOptions call to PayPal */
		$resArray = self::hash_call("SetPaymentOptions", $nvpstr);

		/* Return the response array */
		return $resArray;
	}
	
	private static function CallPreapprovalDetails($preapprovalKey)
	{
		/* Gather the information to make the PreapprovalDetails call.
			The variable nvpstr holds the name value pairs
		*/
		
		// required fields
		$nvpstr = "preapprovalKey=" . urlencode($preapprovalKey);

		/* Make the PreapprovalDetails call to PayPal */
		$resArray = self::hash_call("PreapprovalDetails", $nvpstr);

		/* Return the response array */
		return $resArray;
	}
	
	private static function CallPreapproval($returnUrl, $cancelUrl, $currencyCode, $startingDate, $endingDate, $maxTotalAmountOfAllPayments, $senderEmail, $maxNumberOfPayments, $paymentPeriod, $dateOfMonth, $dayOfWeek, $maxAmountPerPayment, $maxNumberOfPaymentsPerPeriod, $pinType)
	{
		/* Gather the information to make the Preapproval call.
			The variable nvpstr holds the name value pairs
		*/
		
		// required fields
		$nvpstr = "returnUrl=" . urlencode($returnUrl) . "&cancelUrl=" . urlencode($cancelUrl);
		$nvpstr .= "&currencyCode=" . urlencode($currencyCode) . "&startingDate=" . urlencode($startingDate);
		$nvpstr .= "&endingDate=" . urlencode($endingDate);
		$nvpstr .= "&maxTotalAmountOfAllPayments=" . urlencode($maxTotalAmountOfAllPayments);
		
		// optional fields
		if ("" != $senderEmail)
		{
			$nvpstr .= "&senderEmail=" . urlencode($senderEmail);
		}

		if ("" != $maxNumberOfPayments)
		{
			$nvpstr .= "&maxNumberOfPayments=" . urlencode($maxNumberOfPayments);
		}
		
		if ("" != $paymentPeriod)
		{
			$nvpstr .= "&paymentPeriod=" . urlencode($paymentPeriod);
		}

		if ("" != $dateOfMonth)
		{
			$nvpstr .= "&dateOfMonth=" . urlencode($dateOfMonth);
		}

		if ("" != $dayOfWeek)
		{
			$nvpstr .= "&dayOfWeek=" . urlencode($dayOfWeek);
		}

		if ("" != $maxAmountPerPayment)
		{
			$nvpstr .= "&maxAmountPerPayment=" . urlencode($maxAmountPerPayment);
		}

		if ("" != $maxNumberOfPaymentsPerPeriod)
		{
			$nvpstr .= "&maxNumberOfPaymentsPerPeriod=" . urlencode($maxNumberOfPaymentsPerPeriod);
		}

		if ("" != $pinType)
		{
			$nvpstr .= "&pinType=" . urlencode($pinType);
		}

		/* Make the Preapproval call to PayPal */
		$resArray = self::hash_call("Preapproval", $nvpstr);

		/* Return the response array */
		return $resArray;
	}
	
	private static function hash_call($methodName, $nvpStr)
	{
		self::$__apiEndpoint .= "/" . $methodName;
		//setting the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, self::$__apiEndpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);

		//turning off the server and peer verification(TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);
		
		// Set the HTTP Headers
		curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
		'X-PAYPAL-REQUEST-DATA-FORMAT: NV',
		'X-PAYPAL-RESPONSE-DATA-FORMAT: NV',
		'X-PAYPAL-SECURITY-USERID: ' . self::$__apiUsername,
		'X-PAYPAL-SECURITY-PASSWORD: ' .self::$__apiPassword,
		'X-PAYPAL-SECURITY-SIGNATURE: ' . self::$__apiSignature,
		'X-PAYPAL-SERVICE-VERSION: 1.3.0',
		'X-PAYPAL-APPLICATION-ID: ' . self::$__apiAppid
		));
		
	    //if USE_PROXY constant set to TRUE in Constants.php, then only proxy will be enabled.
		//Set proxy name to PROXY_HOST and port number to PROXY_PORT in constants.php 
		if(self::$__useProxy)
			curl_setopt ($ch, CURLOPT_PROXY, self::$__proxyHost. ":" . self::$__proxyPort); 

		// RequestEnvelope fields
		$detailLevel	= urlencode("ReturnAll");	// See DetailLevelCode in the WSDL for valid enumerations
		$errorLanguage	= urlencode("en_US");		// This should be the standard RFC 3066 language identification tag, e.g., en_US

		// NVPRequest for submitting to server
		$nvpreq = "requestEnvelope.errorLanguage=$errorLanguage&requestEnvelope.detailLevel=$detailLevel";
		$nvpreq .= "&$nvpStr";

		//echo Yii::trace(CVarDumper::dumpAsString($nvpreq),'vardump');
		
		//setting the nvpreq as POST FIELD to curl
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

		//getting response from server
		$response = curl_exec($ch);

		//converting NVPResponse to an Associative Array
		$nvpResArray=self::deformatNVP($response);
		$nvpReqArray=self::deformatNVP($nvpreq);
		$_SESSION['nvpReqArray']=$nvpReqArray;

		if (curl_errno($ch)) 
		{
			// moving to display page to display curl errors
			  $_SESSION['curl_error_no']=curl_errno($ch) ;
			  $_SESSION['curl_error_msg']=curl_error($ch);

			  //Execute the Error handling module to display errors. 
		} 
		else 
		{
			 //closing the curl
		  	curl_close($ch);
		}

		return $nvpResArray;
	}
	
	private static function RedirectToPayPal($cmd)
	{
		// Redirect to paypal.com here

		$payPalURL = "";
		
		if (self::$__env == "sandbox") 
		{
			$payPalURL = "https://www.sandbox.paypal.com/webscr?" . $cmd;
		}
		else
		{
			$payPalURL = "https://www.paypal.com/webscr?" . $cmd;
		}

		//header("Location: ".$payPalURL);
		header("Location: ".$payPalURL,true);
	}
	
	private static function RedirectToPayPalFlow($cmd)
	{
		// Redirect to paypal.com here

		$payPalURL = "";
		
		if (self::$__env == "sandbox") 
		{
			$payPalURL = "https://www.sandbox.paypal.com/webapps/adaptivepayment/flow/pay?" . $cmd;
		}
		else
		{
			$payPalURL = "https://www.paypal.com/webapps/adaptivepayment/flow/pay?" . $cmd;
		}

		//header("Location: ".$payPalURL);
		header("Location: ".$payPalURL,true);
	}
	
	private static function deformatNVP($nvpstr)
	{
		$intial=0;
	 	$nvpArray = array();

		while(strlen($nvpstr))
		{
			//postion of Key
			$keypos= strpos($nvpstr,'=');
			//position of value
			$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);

			/*getting the Key and Value values and storing in a Associative Array*/
			$keyval=substr($nvpstr,$intial,$keypos);
			$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
			//decoding the respose
			$nvpArray[urldecode($keyval)] =urldecode( $valval);
			$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
	     }
		return $nvpArray;
	}
	
	private static function generateCharacter()
	{
		$possible = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
		return $char;
	}
	
	private static function generateTrackingID()
	{
		$GUID = self::generateCharacter().self::generateCharacter().self::generateCharacter().self::generateCharacter().self::generateCharacter();
		$GUID .= self::generateCharacter().self::generateCharacter().self::generateCharacter().self::generateCharacter();
		return $GUID;
	}
	
	private static function generateErrorArray($errorResponse)
	{
		$errors = array();
		for($i = 0; $i <= count($errorResponse); $i++) {
			if(isset($errorResponse['error(' . $i . ').errorId']))
			{
				$errors[$i]['errorId'] = urldecode($errorResponse['error(' . $i . ').errorId']);
				$errors[$i]['message'] = urldecode($errorResponse['error(' . $i . ').message']);
				$errors[$i]['domain'] = urldecode($errorResponse['error(' . $i . ').domain']);
				$errors[$i]['severity'] = urldecode($errorResponse['error(' . $i . ').severity']);
				$errors[$i]['category'] = urldecode($errorResponse['error(' . $i . ').category']);
			}
		}
		return $errors;
	}
	
	/**
     * Logs the IPN results
     *
     * @param boolean IPN result
     * @return void
     */
    public function logResults($success)
    {

        if (!$this->logIpn) return;

        // Timestamp
        $text = '[' . date('m/d/Y g:i A').'] - ';

        // Success or failure being logged?
        $text .= ($success) ? "SUCCESS!\n" : 'FAIL: ' . $this->lastError . "\n";

        // Log the POST variables
        $text .= "IPN POST Vars from gateway:\n";
		$text .= print_r($this->ipnData,true)."\n";
		$text .= "IPN POST Vars to gateway:\n";
		$text .= print_r($this->request,true)."\n";
		
        // Log the response from the paypal server
        $text .= "\nIPN Response from gateway Server:\n " . $this->ipnResponse;

        // Write to log
        $fp = fopen($this->ipnLogFile,'a');
        fwrite($fp, $text . "\n\n");
        fclose($fp);
    }
}
