<?php
/**
 * PayPalModel
 **/
class PayPalForm extends CModel
{
	public $order_id;
	public $email;
	public $currency;

	public function attributeNames() {
		return array(
				'order_id' => Shop::t('Order id'),
				'currency' => Shop::t('Currency'),
				'email' => Shop::t('Email'),
				);
	}

	public function beforeValidate() {
		/*
		if(Shop::module()->currencySymbol == '€')
			$this->currency = 'EUR';
		if(Shop::module()->currencySymbol == '$')
			$this->currency = 'USD';
		*/
		$this->currency = Shop::module()->currency;

		return parent::beforeValidate(); 
	}

	public function rules()
	{
		return array(
				array('email', 'CEmailValidator'),
				array('order_id, currency', 'required')
					);
	}

	public function handlePayPal($order) {
		if(Shop::module()->payPalMethod !== false 
				&& $order->payment_method == Shop::module()->payPalMethod) {

				Yii::import('application.modules.shop.components.payment.Paypal');
				$paypal = new Paypal();
				
				// paypal email
				$paypal->addField('business', Shop::module()->payPalBusinessEmail);

				// Specify the currency
				$paypal->addField('currency_code', $this->currency);

				// Specify the url where paypal will send the user on success/failure
				$paypal->addField('return',
						Yii::app()->controller->createAbsoluteUrl('//shop/order/success'));
				$paypal->addField('cancel_return',
						Yii::app()->controller->createAbsoluteUrl('//shop/order/failure'));
				$paypal->addField('notify_url',
						Yii::app()->controller->createAbsoluteUrl('//shop/order/ipn'));

				// Specify the product information
				$paypal->addField('order_id', $order->order_id);
				$paypal->addField('item_name', Shop::t(
							'Order number #{order_id}', array(
								'{order_id}' => $order->order_id)));
								
				$paypal->addField('amount', $order->getTotalPrice());

				if(Shop::module()->payPalTestMode)
					$paypal->enableTestMode();

				// Let's start the train!
				return $paypal->submitPayment();

		}
		return true;
	}
	
	public function handlePayPalCart($order) {
		if(Shop::module()->payPalMethod !== false 
				&& $order->payment_method == Shop::module()->payPalMethod) {

				Yii::import('application.modules.shop.components.payment.Paypal');
				$paypal = new Paypal();
				$paypal->addField('upload', '1');
				// paypal email
				$paypal->addField('business', Shop::module()->payPalBusinessEmail);

				// Specify the currency
				$paypal->addField('currency_code', $this->currency);

				// Specify the url where paypal will send the user on success/failure
				$paypal->addField('return',
						Yii::app()->controller->createAbsoluteUrl('//shop/order/success'));
				$paypal->addField('cancel_return',
						Yii::app()->controller->createAbsoluteUrl('//shop/order/failure'));
				$paypal->addField('notify_url',
						Yii::app()->controller->createAbsoluteUrl('//shop/order/ipn'));

				$paypal->addField('no_shipping', '1');
				$paypal->addField('invoice', self::generateTrackingID());
						
				// Specify the product information
				//$paypal->addField('order_id', $order->order_id);
				$item_cnt = 1;
				$total_amt = 0;
				if($order->positions){
					foreach($order->positions as $position){
						if(intval($position->product_id)!==0){
							for ($i = 1; $i <= $position->amount; $i++) {
								$product = $position->product;
								$paypal->addField('item_name_'.$item_cnt, $product->title.' (size: '.$position->variation->title.')');
								$paypal->addField('amount_'.$item_cnt, $position->unit_price);
								$total_amt = $total_amt + $position->unit_price;
								$item_cnt++;
							}
						}else{
							$paypal->addField('item_name_'.$item_cnt, 'Shipping');
							$paypal->addField('amount_'.$item_cnt, $position->total_price);
							$total_amt = $total_amt + $position->total_price;
							$item_cnt++;
						}
					}
				}
				
				// create ipn record
				$orderIpn = new OrderIpn;
				$orderIpn->tracking_id = $paypal->fields['invoice'];
				$orderIpn->order_id = $order->order_id;
				$orderIpn->receiver_email_1 = $paypal->fields['business'];
				$orderIpn->amount_1 = $total_amt;
				$orderIpn->receiver_email_2 = $paypal->fields['business'];
				$orderIpn->amount_2 = 0;
				$orderIpn->status = 'PendingIPN';
				$orderIpn->save();

				if(Shop::module()->payPalTestMode)
					$paypal->enableTestMode();

				// Let's start the train!
				return $paypal->submitPayment();

		}
		return true;
	}

	public function handlePayPalAP($order) {
		if(Shop::module()->payPalMethod !== false 
				&& $order->payment_method == Shop::module()->payPalMethod) {
				
				Yii::import('application.modules.shop.components.PayPalAP.PayPalAP');
				
				//build option
				$options=array();
				$options['cancelUrl'] = Yii::app()->controller->createAbsoluteUrl('//shop/order/failure');
				$options['returnUrl'] = Yii::app()->controller->createAbsoluteUrl('//shop/order/success');
				$options['senderEmail'] = '';
				$options['currencyCode'] = $this->currency;
				$email1 = Shop::module()->payPalBusinessEmail;
				$email2 = $order->store->hook_paypal;
				$options['receiverEmailArray'] = array($email1,$email2);
				$price1 = $order->getTotalPrice();
				$price2 = $price1*Shop::module()->payPercentage;
				$options['receiverAmountArray'] = array($price1,$price2);
				$options['receiverPrimaryArray'] = array(true,false);
				$options['receiverInvoiceIdArray'] = array($order->order_id,$order->order_id);
				$options['feesPayer'] = '';
				$options['ipnNotificationUrl'] = Yii::app()->controller->createAbsoluteUrl('//shop/order/ipnap');
				$options['memo'] = '';
				$options['pin'] = '';
				$options['preapprovalKey'] = '';
				$options['reverseAllParallelPaymentsOnError'] = '';
				
				$options['trackingId'] = self::generateTrackingID();
				
				// create ipn record
				$orderIpn = new OrderIpn;
				$orderIpn->tracking_id = $options['trackingId'];
				$orderIpn->order_id = $order->order_id;
				$orderIpn->receiver_email_1 = $email1;
				$orderIpn->amount_1 = $price1;
				$orderIpn->receiver_email_2 = $email2;
				$orderIpn->amount_2 = $price2;
				$orderIpn->status = 'PendingIPN';
				$orderIpn->save();
				
				//do payment
				$paypal = new PayPalAP();
				if(Shop::module()->payPalTestMode)
					$paypal->setAuth(Shop::module()->payPalAPIUsername, Shop::module()->payPalAPIPassword, Shop::module()->payPalAPISignature, Shop::module()->payPalAPIAppID,'sandbox');
				else
					$paypal->setAuth(Shop::module()->payPalAPIUsername, Shop::module()->payPalAPIPassword, Shop::module()->payPalAPISignature, Shop::module()->payPalAPIAppID,'');
				$ppresult = $paypal->doPayment($options);
				return $ppresult['success'];
				}
		return true;
	}
	
	public function handlePayPalAPDetail($order) {
		if(Shop::module()->payPalMethod !== false 
				&& $order->payment_method == Shop::module()->payPalMethod) {
				
				Yii::import('application.modules.shop.components.PayPalAP.PayPalAP');
				
				//build option
				$options=array();
				$options['actionType'] = 'CREATE';
				$options['cancelUrl'] = Yii::app()->controller->createAbsoluteUrl('//shop/order/failure');
				$options['returnUrl'] = Yii::app()->controller->createAbsoluteUrl('//shop/order/success');
				$options['senderEmail'] = '';
				$options['currencyCode'] = $this->currency;
				$email1 = $order->store->hook_paypal;
				$email2 = Shop::module()->payPalBusinessEmail;
				//$email1 = Shop::module()->payPalBusinessEmail;
				//$email2 = $order->store->hook_paypal;
				$options['receiverEmailArray'] = array($email1,$email2);
				$price1 = $order->getTotalPrice();
				$price2 = $price1*Shop::module()->payPercentage;
				$options['receiverAmountArray'] = array($price1,$price2);
				$options['receiverPrimaryArray'] = array(true,false);
				$options['receiverInvoiceIdArray'] = array($order->order_id,$order->order_id);
				$options['feesPayer'] = '';
				$options['ipnNotificationUrl'] = Yii::app()->controller->createAbsoluteUrl('//shop/order/ipnap');
				$options['memo'] = '';
				$options['pin'] = '';
				$options['preapprovalKey'] = '';
				$options['reverseAllParallelPaymentsOnError'] = '';
				
				$options['trackingId'] = self::generateTrackingID();
				//echo Yii::trace(CVarDumper::dumpAsString($options),'vardump');
				// do create payment
				$paypal = new PayPalAP();
				if(Shop::module()->payPalTestMode)
					$paypal->setAuth(Shop::module()->payPalAPIUsername, Shop::module()->payPalAPIPassword, Shop::module()->payPalAPISignature, Shop::module()->payPalAPIAppID,'sandbox');
				else
					$paypal->setAuth(Shop::module()->payPalAPIUsername, Shop::module()->payPalAPIPassword, Shop::module()->payPalAPISignature, Shop::module()->payPalAPIAppID,'');
				$ppresult = $paypal->doPayment($options);
				//echo Yii::trace(CVarDumper::dumpAsString($ppresult),'vardump');
				
				// set payment details
				$payOpt=array();
				$payKey=$ppresult['details']['payKey'];
				if($ppresult['success']){
					$payOpt['payKey']=$payKey;
					$payOpt['displayName']='Test';
					$payOpt['email']='Test@abc.com';
					$payOpt['firstName']='jc';
					$payOpt['institutionCustomerId']='1';
					$payOpt['institutionId']=$payKey;
					$payOpt['lastName']='test';
					
					$deliveryAddress=$order->deliveryAddress;
					if($deliveryAddress){
						//$payOpt['addresseeName']=$deliveryAddress->title.', '.$deliveryAddress->firstname.' '.$deliveryAddress->lastname;
						$payOpt['addresseeName']=$deliveryAddress->firstname.' '.$deliveryAddress->lastname;
						$payOpt['street1']=$deliveryAddress->street;
						$payOpt['street2']='';
						$payOpt['city']=$deliveryAddress->city;
						$payOpt['state']='';
						$payOpt['zip']=$deliveryAddress->zipcode;
						$payOpt['country']=$deliveryAddress->country;
					}else{
						$payOpt['addresseeName']='Dearest Kickzmall Customer';
						$payOpt['street1']='';
						$payOpt['street2']='';
						$payOpt['city']='';
						$payOpt['state']='';
						$payOpt['zip']='';
						$payOpt['country']='US';
					}
					//$payOpt['receiverEmail']=Shop::module()->payPalBusinessEmail;
					$payOpt['receiverEmail']=$order->store->hook_paypal;
					
					$productName='';
					$productTotalPrice=0;
					$productUnitPrice=0;
					$productCount=0;
					//$totalShipping=0;
					
					$payOpt['itemNameArray']=array();
					$payOpt['itemPriceArray']=array();
					$payOpt['itemItemPriceArray']=array();
					$payOpt['itemItemCountArray']=array();
					if($order->positions){
						foreach($order->positions as $position){
							if(intval($position->product_id)!==0){
								$product=$position->product;
								$productName=$product->title.' (size: '.$position->variation->title.')';
								$productTotalPrice=$position->total_price;
								$productUnitPrice=$position->unit_price;
								$productCount=$position->amount;
								
								$payOpt['itemNameArray'][]=$productName;
								$payOpt['itemPriceArray'][]=$productTotalPrice;
								$payOpt['itemItemPriceArray'][]=$productUnitPrice;
								$payOpt['itemItemCountArray'][]=$productCount;
							}else{
								$payOpt['totalShipping']=$position->total_price;
							}
						}
					}
					
					//echo Yii::trace(CVarDumper::dumpAsString($payOpt),'vardump');
					$paypal = new PayPalAP();
					if(Shop::module()->payPalTestMode)
						$paypal->setAuth(Shop::module()->payPalAPIUsername, Shop::module()->payPalAPIPassword, Shop::module()->payPalAPISignature, Shop::module()->payPalAPIAppID,'sandbox');
					else
						$paypal->setAuth(Shop::module()->payPalAPIUsername, Shop::module()->payPalAPIPassword, Shop::module()->payPalAPISignature, Shop::module()->payPalAPIAppID,'');
					$ppresult = $paypal->doSetPaymentOptions($payOpt);
					//echo Yii::trace(CVarDumper::dumpAsString($ppresult),'vardump');
					
					
				}
				
				
				// create ipn record
				$orderIpn = new OrderIpn;
				$orderIpn->tracking_id = $options['trackingId'];
				$orderIpn->order_id = $order->order_id;
				$orderIpn->receiver_email_1 = $email1;
				$orderIpn->amount_1 = $price1;
				$orderIpn->receiver_email_2 = $email2;
				$orderIpn->amount_2 = $price2;
				$orderIpn->status = 'PendingIPN';
				$orderIpn->save();
				
				return $ppresult['success'];
				}
		return true;
	}
	
	public function handleFeaturePayPal($product,$day) {
		Yii::import('application.modules.shop.components.payment.Paypal');
		$paypal = new Paypal();
		
		// paypal email
		$paypal->addField('business', Shop::module()->payPalBusinessEmail);
		
		// No shipping
		$paypal->addField('no_shipping', 1);

		// Specify the currency
		$paypal->addField('currency_code', $this->currency);

		// Specify the url where paypal will send the user on success/failure
		$paypal->addField('return',
				Yii::app()->controller->createAbsoluteUrl('//shop/products/success/',array('id'=>$product->product_id)));
		$paypal->addField('cancel_return',
				Yii::app()->controller->createAbsoluteUrl('//shop/products/failure/',array('id'=>$product->product_id)));
		$paypal->addField('notify_url',
				Yii::app()->controller->createAbsoluteUrl('//shop/products/ipn'));

		// Specify the product information
		$order_no=date('YmdHis').'-'.$product->product_id;
		$paypal->addField('order_id', $order_no);
		$paypal->addField('custom', $order_no);
		$paypal->addField('item_name', Shop::t(
					'Feature Product for {day} day(s) #{order_id}', array(
						'{day}' => $day,
						'{order_id}' => $order_no)));
		$amount=Shop::module()->featureProductFee*$day;
		$paypal->addField('amount', $amount);
		$handlingFee = round(Shop::module()->payPalHandlingFeePercentage*$amount, 2);
		$paypal->addField('handling',$handlingFee);

		if(Shop::module()->payPalTestMode)
			$paypal->enableTestMode();

		// Add ipn
		$featureIpn = new FeatureIpn;
		$featureIpn->id = $order_no;
		$featureIpn->product_id = $product->product_id;
		$featureIpn->receiver_email = Shop::module()->payPalBusinessEmail;
		$featureIpn->amount = $amount+$handlingFee;
		$featureIpn->no_of_day = $day;
		$featureIpn->status = 'PendingIPN';
		$featureIpn->feature_type = 'feature';
		$featureIpn->save();

			
		// Let's start the train!
		return $paypal->submitPayment();

		//return true;
	}
	
	public function handleGalleryPayPal($product,$day) {
		Yii::import('application.modules.shop.components.payment.Paypal');
		$paypal = new Paypal();
		
		// paypal email
		$paypal->addField('business', Shop::module()->payPalBusinessEmail);
		
		// No shipping
		$paypal->addField('no_shipping', 1);

		// Specify the currency
		$paypal->addField('currency_code', $this->currency);

		// Specify the url where paypal will send the user on success/failure
		$paypal->addField('return',
				Yii::app()->controller->createAbsoluteUrl('//shop/products/gallerySuccess/',array('id'=>$product->product_id)));
		$paypal->addField('cancel_return',
				Yii::app()->controller->createAbsoluteUrl('//shop/products/galleryFailure/',array('id'=>$product->product_id)));
		$paypal->addField('notify_url',
				Yii::app()->controller->createAbsoluteUrl('//shop/products/galleryIpn'));

		// Specify the product information
		$order_no=date('YmdHis').'-'.$product->product_id;
		$paypal->addField('order_id', $order_no);
		$paypal->addField('custom', $order_no);
		$paypal->addField('item_name', Shop::t(
					'Gallery Product for {day} day(s) #{order_id}', array(
						'{day}' => $day,
						'{order_id}' => $order_no)));
		$amount=Shop::module()->galleryProductFee*$day;
		$paypal->addField('amount', $amount);
		$handlingFee = round(Shop::module()->payPalHandlingFeePercentage*$amount, 2);
		$paypal->addField('handling',$handlingFee);

		if(Shop::module()->payPalTestMode)
			$paypal->enableTestMode();

		// Add ipn
		$featureIpn = new FeatureIpn;
		$featureIpn->id = $order_no;
		$featureIpn->product_id = $product->product_id;
		$featureIpn->receiver_email = Shop::module()->payPalBusinessEmail;
		$featureIpn->amount = $amount+$handlingFee;
		$featureIpn->no_of_day = $day;
		$featureIpn->status = 'PendingIPN';
		$featureIpn->feature_type = 'gallery';
		$featureIpn->save();

			
		// Let's start the train!
		return $paypal->submitPayment();

		//return true;
	}
	
	private static function generateCharacter()
	{
		$possible = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
		return $char;
	}
	
	private static function generateTrackingID()
	{
		$GUID = date("YmdHis").self::generateCharacter().self::generateCharacter().self::generateCharacter().self::generateCharacter().self::generateCharacter();
		$GUID .= self::generateCharacter().self::generateCharacter().self::generateCharacter().self::generateCharacter();
		return $GUID;
	}
}
