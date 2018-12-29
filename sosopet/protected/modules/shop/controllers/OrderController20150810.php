<?php

class OrderController extends ShController
{
	public $_model;
	public $_ipnLog=false;
	public $_ipnLogFile;
	public $_ipnData;

	public function filters()
	{
		return array(
				'accessControl',
				);
	}	

	public function accessRules() {
		return array(
				array('allow',
					'actions'=>array('ipn','ipnap'),
					'users' => array('*'),
					),
				array('allow',
					'actions'=>array('create', 'confirm', 'review', 'success', 'failure', 'paypal'),
					'users' => array('@'),
					),
				array('allow',
					'actions'=>array('index', 'view','admin','list'),
					'users' => array('@'),
					),
				array('allow',
					'actions'=>array('delete', 'slip', 'invoice', 'update'),
					'users' => array('admin'),
					),
				array('deny',  // deny all other users
					'users'=>array('*'),
					),
				);
	}

	public function actionSlip($id) {
		if($model = $this->loadModel($id))
			if(Shop::module()->useTcPdf)
				$this->renderPartial(Shop::module()->slipViewPdf, array(
							'model' => $model));
			else
				$this->render(Shop::module()->slipView, array('model' => $model));
	}

	public function actionInvoice($id) {
		if($model = $this->loadModel($id))
			$this->render(Shop::module()->invoiceView, array('model' => $model));
	}

	public function beforeAction($action) {
		$this->layout = Shop::module()->layout;
		return parent::beforeAction($action);
	}

	public function actionView($id)
	{
		$model = Order::model()->with('customer')->findbyPk($id);

		if($model) {
			if($model->customer->user_id == Yii::app()->user->id
					|| (Shop::module()->useWithYum && Yii::app()->user->isAdmin()) 
					|| Yii::app()->user->id == 'admin')
			{

				if(!$model->paymentMethod instanceof PaymentMethod)
					Shop::log(Shop::t('Invalid payment method in order #{order_id}', array(
									'{order_id}' => $model->order_id)), 'warning');

				if(!$model->shippingMethod instanceof shippingMethod)
					Shop::log(Shop::t('Invalid shipping method in order #{order_id}', array(
									'{order_id}' => $model->order_id)), 'warning');

				$this->render('view',array(
							'model'=>$model
							));
			} else
				throw new CHttpException(403, Shop::t(
							'You are not allowed to view this order'));

		} else throw new CHttpException(404, Shop::t(
					'The requested Order could not be found'));
	}

	public function mailConfirmationMessage($order, $message) {
		$email = $order->customer->email;
		$title = Shop::t('Order confirmation');


		if(mail($email, $title, $message))
			Shop::setFlash(Shop::t('A order confirmation has been sent'));
		else
			Shop::setFlash(Shop::t('Error while sending confirmation message'));

	}

	public function actionUpdate($id) {
		$order = $this->loadModel();
		if( (Shop::module()->useWithYum && Yii::app()->user->isAdmin()) 
			|| Yii::app()->user->id == 'admin') {

		if(isset($_POST['Order'])) {
			if(
					isset($_POST['SendConfirmationMessage'])
					&& $_POST['SendConfirmationMessage'] == 1
					&& isset($_POST['ConfirmationMessage']))
				$this->mailConfirmationMessage($order, $_POST['ConfirmationMessage']);	

			$order->attributes = $_POST['Order'];
			$order->save();
			$this->redirect(array('//shop/order/view', 'id' => $order->order_id));
		}
		$this->render('update', array('model' => $order));	
		} else
			throw new CHttpException(403);
	}

	/** Creation of a new Order 
	 * Before we create a new order, we need to gather Customer information.
	 * If the user is logged in, we check if we already have customer information.
	 * If so, we go directly to the Order confirmation page with the data passed
	 * over. Otherwise we need the user to enter his data, and depending on
	 * whether he is logged in into the system it is saved with his user 
	 * account or once just for this order.	
	 */
	public function actionCreate(
			$customer = null,
			$payment_method = null,
			$shipping_method = null,
			$shipping_option = null) {

		// Shopping cart is empty, taking a order is not allowed yet
		if(Shop::getCartContent() == array())
			$this->redirect(array('//shop/shoppingCart/view'));
		
		$cart = Shop::getCartContent();
		$shoppingCart = new ShoppingCartForm;
		$shoppingCart->cart=$cart;
		//$shoppingCart->attributes = array('cart'=>$cart);
		if(!$shoppingCart->validate())
			$this->redirect(array('//shop/shoppingCart/view'));

			
		if(!$customer){
			$customer = Yii::app()->user->getState('customer_id');
			if(is_numeric($customer))
				$customer = Customer::model()->findByPk($customer);
		}
		if(!Yii::app()->user->isGuest && !$customer)
			$customer = Customer::model()->find('user_id = :user_id ', array(
						':user_id' => Yii::app()->user->id));
		
		$address = new Address;
		$deliveryAddress = new DeliveryAddress;
		$BillingAddress = new BillingAddress;
		if($customer) {
			$address = $customer->address;
			if(!$address)
				$address = new Address;
			//echo Yii::trace(CVarDumper::dumpAsString($customer->billing_address_id),'vardumpx');
			//echo Yii::trace(CVarDumper::dumpAsString($customer->delivery_address_id),'vardumpx');
			//echo Yii::trace(CVarDumper::dumpAsString($customer->address),'vardumpx');
			//echo Yii::trace(CVarDumper::dumpAsString($customer->deliveryAddress),'vardumpx');
			//echo Yii::trace(CVarDumper::dumpAsString($customer->billingAddress),'vardumpx');
			$deliveryAddress = $customer->deliveryAddress;
			if(!$deliveryAddress)
				$deliveryAddress = new DeliveryAddress;
			$BillingAddress = $customer->billingAddress;
			if(!$BillingAddress)
				$BillingAddress = new BillingAddress;
		}else{
			$customer = new Customer;
			$customer->user_id = Yii::app()->user->id;
		}
		
		if(isset($_POST['ShippingMethod'])) 
			Yii::app()->user->setState('shipping_method', $_POST['ShippingMethod']);
			
		if(isset($_POST['ShippingOption'])) 
			Yii::app()->user->setState('shipping_option', $_POST['ShippingOption']);

		if(isset($_POST['PaymentMethod'])) 
			Yii::app()->user->setState('payment_method', $_POST['PaymentMethod']);
		
		if(isset($_POST['Customer']))
		{
			$customer->attributes = $_POST['Customer'];
			if(isset($_POST['DeliveryAddress'])) {
				//$address = new Address;
				$address->attributes = $_POST['DeliveryAddress'];
				if($address->save())
					$customer->address_id = $address->id;
			}
			//if(!Yii::app()->user->isGuest)
			//	$customer->user_id = Yii::app()->user->id;
			$customer->save();
		}
		
		if(isset($_POST['DeliveryAddress'])) {
			if(Address::isEmpty($_POST['DeliveryAddress'])) {
				Shop::setFlash(Shop::t('Delivery address is not complete! Please fill in all fields to set the Delivery address'));
			} else {
				//$deliveryAddress = new DeliveryAddress;
				$deliveryAddress->attributes = $_POST['DeliveryAddress'];
				if($deliveryAddress->save()) {
					//$model = Shop::getCustomer();

					$customer->delivery_address_id = $deliveryAddress->id;

					$customer->save(false, array('delivery_address_id'));
				}
			}
		}
		
		$sameAsShip = false;
		//echo Yii::trace(CVarDumper::dumpAsString('testtesttesttesttesttest'),'vardumpx');
		//if(isset($_POST['sameAsShip']))
		//	echo Yii::trace(CVarDumper::dumpAsString($_POST['sameAsShip']),'vardumpx');
		//$sameAsShip = isset($_POST['sameAsShip']);
		//if($sameAsShip){
			//if(isset($_POST['DeliveryAddress'])) {
		//		$BillingAddress->attributes = $deliveryAddress->attributes;
			//}
		//}else{
			if(isset($_POST['BillingAddress'])) {
				if(Address::isEmpty($_POST['BillingAddress'])) {
					Shop::setFlash(Shop::t('Billing address is not complete! Please fill in all fields to set the Billing address'));
				} else {
					//$BillingAddress = new BillingAddress;
					$BillingAddress->attributes = $_POST['BillingAddress'];
					if($BillingAddress->save()) {
						//$model = Shop::getCustomer();

						$customer->billing_address_id = $BillingAddress->id;

						$customer->save(false, array('billing_address_id'));
					}
				}
			}
		//}
		
		if(!$payment_method)
			$payment_method = Yii::app()->user->getState('payment_method');
		//if(!$shipping_method)
		//	$shipping_method = Yii::app()->user->getState('shipping_method');
		if(!$shipping_option)
			$shipping_option = Yii::app()->user->getState('shipping_option');

		//Yii::app()->end();
			
		//if(!$customer) {
		//	$this->render('/customer/create', array(
		//				'action' => array('//shop/customer/create')));
		//	Yii::app()->end();
		//}
		
		
		if($customer && $deliveryAddress && $BillingAddress && $customer->customer_id && $deliveryAddress->id && $BillingAddress->id && $payment_method && $shipping_option) {
			//if(is_numeric($customer))
			//	$customer = Customer::model()->findByPk($customer);
			//if(is_numeric($shipping_method))
			//	$shipping_method = ShippingMethod::model()->find('id = :id', array(
			//				':id' => $shipping_method));
			$customer = Customer::model()->find('user_id = :user_id ', array(
						':user_id' => Yii::app()->user->id));
			if($shipping_option)
				$shipping_option=Shop::getCartShippingMethods($shipping_option);
			if(is_numeric($payment_method))
				$payment_method = PaymentMethod::model()->findByPk($payment_method);
			//echo Yii::trace(CVarDumper::dumpAsString($customer),'vardumpx');
			$this->render('/order/create', array(
						'customer' => $customer,
						'deliveryAddress' => $deliveryAddress,
						'BillingAddress' => $BillingAddress,
						'paymentMethod' => $payment_method,
						'shippingOption' => $shipping_option,
						'sameAsShip' => $sameAsShip?'1':'',
						));

		}else{
			$this->render('/order/create', array(
						'customer' => $customer,
						'deliveryAddress' => $deliveryAddress,
						'BillingAddress' => $BillingAddress,
						'paymentMethod' => $payment_method,
						'shippingOption' => $shipping_option,
						'sameAsShip' => $sameAsShip?'1':'',
						));
		}
	}
	
	public function actionReview(
			$customer = null,
			$payment_method = null,
			$shipping_method = null,
			$shipping_option = null) {

		// Shopping cart is empty, taking a order is not allowed yet
		if(Shop::getCartContent() == array())
			$this->redirect(array('//shop/shoppingCart/view'));
		
		$cart = Shop::getCartContent();
		$shoppingCart = new ShoppingCartForm;
		$shoppingCart->cart=$cart;
		//$shoppingCart->attributes = array('cart'=>$cart);
		if(!$shoppingCart->validate())
			$this->redirect(array('//shop/shoppingCart/view'));

			
		if(!$customer){
			$customer = Yii::app()->user->getState('customer_id');
			if(is_numeric($customer))
				$customer = Customer::model()->findByPk($customer);
		}
		if(!Yii::app()->user->isGuest && !$customer)
			$customer = Customer::model()->find('user_id = :user_id ', array(
						':user_id' => Yii::app()->user->id));
		
		$address = new Address;
		$deliveryAddress = new DeliveryAddress;
		$BillingAddress = new BillingAddress;
		if($customer) {
			$address = $customer->address;
			if(!$address)
				$address = new Address;
			//echo Yii::trace(CVarDumper::dumpAsString($customer->billing_address_id),'vardumpx');
			//echo Yii::trace(CVarDumper::dumpAsString($customer->delivery_address_id),'vardumpx');
			//echo Yii::trace(CVarDumper::dumpAsString($customer->address),'vardumpx');
			//echo Yii::trace(CVarDumper::dumpAsString($customer->deliveryAddress),'vardumpx');
			//echo Yii::trace(CVarDumper::dumpAsString($customer->billingAddress),'vardumpx');
			$deliveryAddress = $customer->deliveryAddress;
			if(!$deliveryAddress)
				$deliveryAddress = new DeliveryAddress;
			$BillingAddress = $customer->billingAddress;
			if(!$BillingAddress)
				$BillingAddress = new BillingAddress;
		}else{
			$customer = new Customer;
			$customer->user_id = Yii::app()->user->id;
		}
		
		if(isset($_POST['ShippingMethod'])) 
			Yii::app()->user->setState('shipping_method', $_POST['ShippingMethod']);
			
		if(isset($_POST['ShippingOption'])) 
			Yii::app()->user->setState('shipping_option', $_POST['ShippingOption']);

		if(isset($_POST['PaymentMethod'])) 
			Yii::app()->user->setState('payment_method', $_POST['PaymentMethod']);
		
		if(isset($_POST['Customer']))
		{
			$customer->attributes = $_POST['Customer'];
			if(isset($_POST['DeliveryAddress'])) {
				//$address = new Address;
				$address->attributes = $_POST['DeliveryAddress'];
				if($address->save())
					$customer->address_id = $address->id;
			}
			//if(!Yii::app()->user->isGuest)
			//	$customer->user_id = Yii::app()->user->id;
			$customer->save();
		}
		
		if(isset($_POST['DeliveryAddress'])) {
			if(Address::isEmpty($_POST['DeliveryAddress'])) {
				Shop::setFlash(Shop::t('Delivery address is not complete! Please fill in all fields to set the Delivery address'));
			} else {
				//$deliveryAddress = new DeliveryAddress;
				$deliveryAddress->attributes = $_POST['DeliveryAddress'];
				if($deliveryAddress->save()) {
					//$model = Shop::getCustomer();

					$customer->delivery_address_id = $deliveryAddress->id;

					$customer->save(false, array('delivery_address_id'));
				}
			}
		}

		$sameAsShip = false;
		if(isset($_POST['sameAsShip'])){
			//echo Yii::trace(CVarDumper::dumpAsString($_POST['sameAsShip']),'vardumpx');
			if($_POST['sameAsShip']=='1')
				$sameAsShip = true;
		}
		//$sameAsShip = isset($_POST['sameAsShip']);
		if($sameAsShip){
			if(Address::isEmpty($_POST['DeliveryAddress'])) {
				Shop::setFlash(Shop::t('Delivery address is not complete! Please fill in all fields to set the Delivery address'));
			} else {
				//$deliveryAddress = new DeliveryAddress;
				$BillingAddress->attributes = $_POST['DeliveryAddress'];
				if($BillingAddress->save()) {
					//$model = Shop::getCustomer();

					$customer->billing_address_id = $BillingAddress->id;

					$customer->save(false, array('billing_address_id'));
				}
			}
		}else{
			if(isset($_POST['BillingAddress'])) {
				if(Address::isEmpty($_POST['BillingAddress'])) {
					Shop::setFlash(Shop::t('Billing address is not complete! Please fill in all fields to set the Billing address'));
				} else {
					//$BillingAddress = new BillingAddress;
					$BillingAddress->attributes = $_POST['BillingAddress'];
					if($BillingAddress->save()) {
						//$model = Shop::getCustomer();

						$customer->billing_address_id = $BillingAddress->id;

						$customer->save(false, array('billing_address_id'));
					}
				}
			}
		}
		
		if(!$payment_method)
			$payment_method = Yii::app()->user->getState('payment_method');
		//if(!$shipping_method)
		//	$shipping_method = Yii::app()->user->getState('shipping_method');
		if(!$shipping_option)
			$shipping_option = Yii::app()->user->getState('shipping_option');

		//Yii::app()->end();
			
		//if(!$customer) {
		//	$this->render('/customer/create', array(
		//				'action' => array('//shop/customer/create')));
		//	Yii::app()->end();
		//}
		
		
		if($customer && $deliveryAddress && $BillingAddress && $customer->customer_id && $deliveryAddress->id && $BillingAddress->id && $payment_method && $shipping_option) {
			//if(is_numeric($customer))
			//	$customer = Customer::model()->findByPk($customer);
			//if(is_numeric($shipping_method))
			//	$shipping_method = ShippingMethod::model()->find('id = :id', array(
			//				':id' => $shipping_method));
			$customer = Customer::model()->find('user_id = :user_id ', array(
						':user_id' => Yii::app()->user->id));
			if($shipping_option)
				$shipping_option=Shop::getCartShippingMethods($shipping_option);
			if(is_numeric($payment_method))
				$payment_method = PaymentMethod::model()->findByPk($payment_method);
			//echo Yii::trace(CVarDumper::dumpAsString($customer),'vardumpx');
			$this->render('/order/confirm', array(
						'customer' => $customer,
						'paymentMethod' => $payment_method,
						'shippingOption' => $shipping_option,
						));

		}else{
			$this->render('/order/create', array(
						'customer' => $customer,
						'deliveryAddress' => $deliveryAddress,
						'BillingAddress' => $BillingAddress,
						'paymentMethod' => $payment_method,
						'shippingOption' => $shipping_option,
						'sameAsShip' => $sameAsShip?'1':'',
						));
		}
	}

	public function actionConfirm() {
		Yii::app()->user->setState('order_comment', @$_POST['Order']['Comment']);
		//if(isset($_POST['accept_terms']) && $_POST['accept_terms'] == 1) {
			$order = new Order();
			$customer = Shop::getCustomer();
			$cart = Shop::getCartContent();

			$order->customer_id = $customer->customer_id;

			$address = new DeliveryAddress();
			if($customer->deliveryAddress)
				$address->attributes = $customer->deliveryAddress->attributes;
			else
				$address->attributes = $customer->address->attributes;
			$address->save();

			$order->delivery_address_id = $address->id;

			$address = new BillingAddress();
			if($customer->billingAddress)
				$address->attributes = $customer->billingAddress->attributes;
			else
				$address->attributes = $customer->address->attributes;
			$address->save();
			$order->billing_address_id = $address->id;

			$order->ordering_date = time();
			$order->payment_method = Yii::app()->user->getState('payment_method');
			//$order->shipping_method = Yii::app()->user->getState('shipping_method');
			$order->shipping_method = Yii::app()->user->getState('shipping_option');
			$order->comment = Yii::app()->user->getState('order_comment');
			$order->status = 'new';
			$discount = 0;

			//if ($point = Point::model()->find()->id) {
			//	$order->point_id = $point;
			//}

			if($order->save()) {
				foreach($cart as $position => $product) {
					// $position = new OrderPosition;
					// $position->order_id = $order->order_id;
					// $position->product_id = $product['product_id'];
					// $position->amount = $product['amount'];
					// $position->specifications = @json_encode($product['Variations']);
					// $position->save();
					$position = $this->_add_order_position($order, $product);

					//$discount += $position->getPrice();
					$discount += $position->total_price;
					/*
					Yii::app()->user->setState('cart', array());
					Yii::app()->user->setState('shipping_method', null);
					Yii::app()->user->setState('payment_method', null);
					Yii::app()->user->setState('order_comment', null);
					*/
				}
				
				// Add shipping
				$position = $this->_add_order_shipping_position($order, Shop::getCartShippingMethods());
				Shop::mailNotification($order);
				// Shop::flushCart();

				//$discount *= ($order->point->value/100.0);
				//$account = $order->customer->accPoint;
				//if ($account + $discount > $order->point->threshold)
				//{
				//  $account -= ($order->point->threshold - $discount);
				//  $discount = $order->point->threshold;
				//} else {
				//  $account += $discount;
				//  $discount = 0;
				//}

				//$order->customer->accPoint = $account;
				//$order->customer->save();

				// make order position
				// $position = new OrderPosition;
				// $position->order_id = $order->order_id;
				// $position->product_id = $product['product_id'];
				// $position->amount = 1;
				// $position->specifications = @json_encode($product['Variations']);
				// $position->save();

				// make discount position
				//$discountPosition = new DiscountPosition;
				//$discountPosition->order_id = $order->order_id;
				//$discountPosition->amount = $discount;
				//$discountPosition->save();
				$order->store_id=$position->store_id;
				$order->save();

				if(Shop::module()->payPalMethod !== false 
						&& $order->payment_method == Shop::module()->payPalMethod) 
					$this->redirect(array(Shop::module()->payPalUrl, 'order_id' => $order->order_id));
				else
					$this->redirect(Shop::module()->successAction);
			} else 
				$this->redirect(Shop::module()->failureAction);
		//} else {
		//	Shop::setFlash(
		//			Shop::t(
		//				'Please accept our Terms and Conditions to continue'));
		//	$this->redirect(array('//shop/order/review'));
		//}
	}

	public function actionPaypal($order_id = null) {
		$model = new PayPalForm();

		if($order_id !== null)
			$model->order_id = $order_id;

		$order = Order::model()->findByPk($model->order_id);

		if($order->customer->user_id != Yii::app()->user->id)
			throw new CHttpException(403);

		if($order->status != 'new') {
			Shop::setFlash('The order is already paid');
			$this->redirect('//shop/products/index');
		}


		//if(isset($_POST['PayPalForm'])) {
		//	$model->attributes = $_POST['PayPalForm'];

			if($model->validate()) {
				//echo $model->handlePayPal($order);
				echo $model->handlePayPalCart($order);
				//$paypal_result=$model->handlePayPalAP($order);
				//$paypal_result=$model->handlePayPalAPDetail($order);
				
			}
		//}

		//if(!$paypal_result['success'])
		//	$this->render('paypal_redirect_fail');
		//$this->render('/order/paypal_form', array(
		//			'model' => $model));
	}

	public function actionIpn() {
		Yii::import('application.modules.shop.components.payment.Paypal');

		$paypal = new Paypal();
		Shop::log('Paypal payment attempt');

		// Log the IPN results
		$paypal->ipnLog = TRUE;
		$paypal->ipnLogFile = '../logs/ipn.log';

		if(Shop::module()->payPalTestMode)
			$paypal->enableTestMode();
		
		// Check validity and write down it
		if ($paypal->validateIpn())
		{
			// Find ipnap
			$orderIpn = OrderIpn::model()->find('tracking_id = :tracking_id ', array(':tracking_id' => $paypal->ipnData['invoice']));
			
			if (!$orderIpn){
				Shop::log('Paypal payment raised an error :'.var_dump($paypal));
			}else{
				if($this->_validate_ipn_data($orderIpn, $paypal->ipnData))
				{
					$this->_update_ipn_data($orderIpn, $paypal->ipnData);
					if (strtolower($paypal->ipnData['payment_status']) == 'completed')
					{
						// Proceed Order
						$orderIpn->proceedOrder();
						Shop::log('Paypal payment arrived :'.var_dump($paypal));
					}
					else
					{
						Shop::log('Paypal payment raised an error :'.var_dump($paypal));
					}
				}
				else
				{
					Shop::log('Paypal payment raised an error :'.var_dump($paypal));
				}
			}
		} 
	}
	
	public function actionIpnap() {
		Yii::import('application.modules.shop.components.PayPalAP.PayPalAP');

		$paypal = new PayPalAP();
		Shop::log('Paypal payment attempt');

		// Log the IPN results
		$paypal->ipnLog = TRUE;
		//$this->ipnLogFile = '../logs/ipnap.log';
		$paypal->ipnLogFile = Shop::module()->payPalAPLog;

		if(Shop::module()->payPalTestMode)
			$paypal->setEnv('sandbox');
		else
			$paypal->setEnv('');

		// Check validity and write down it
		//if ($paypal->handleIpn($paypal->ipnData))
		if ($paypal->handleIpn())
		{
			// Find ipnap
			$orderIpn = OrderIpn::model()->find('tracking_id = :tracking_id ', array(':tracking_id' => $paypal->ipnData['tracking_id']));
			
			if (!$orderIpn){
				$fp = fopen($paypal->ipnLogFile,'a');
				fwrite($fp, 'Invalid ipn data' . "\n\n");
				fclose($fp);
				Shop::log('Invalid ipn data :'.var_dump($paypal));
				return false;
			}else{
				if($this->_validate_ipnap_data($orderIpn, $paypal->ipnData)){
					$this->_update_ipnap_data($orderIpn, $paypal->ipnData);
					if (strtolower($paypal->ipnData['status']) == 'completed')
					{
						// Proceed Order
						$orderIpn->proceedOrder();
						Shop::log('Paypal payment arrived :'.var_dump($paypal));
					}
					else
					{
						Shop::log('Paypal payment raised an error :'.var_dump($paypal));
					}
				}else{
					$fp = fopen($paypal->ipnLogFile,'a');
					fwrite($fp, 'Invalid ipn data' . "\n\n");
					fclose($fp);
					Shop::log('Invalid ipn data :'.var_dump($paypal));
				}
			}	
		} 
	}
	
	private function _validate_ipnap_data($orderIpn, $ipnData)
	{
		//$fp = fopen('images/ipnap.log','a');
		if($ipnData['transaction[0].receiver']!==$orderIpn->receiver_email_1)
			return false;
		//fwrite($fp, 'email1 passed' . "\n\n");
		if($ipnData['transaction[1].receiver']!==$orderIpn->receiver_email_2)
			return false;
		//fwrite($fp, 'email2 passed' . "\n\n");
		
		//fwrite($fp, number_format(trim($ipnData['transaction[0].amount'],'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ '),6,'.','') . "\n\n");
		//fwrite($fp, number_format($orderIpn->amount_1,6,'.','') . "\n\n");
		//fwrite($fp, number_format(trim($ipnData['transaction[1].amount'],'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ '),6,'.','') . "\n\n");
		//fwrite($fp, number_format($orderIpn->amount_2,6,'.','') . "\n\n");
		
		if(number_format(trim($ipnData['transaction[0].amount'],'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ '),6,'.','')!==number_format($orderIpn->amount_1,6,'.',''))
			return false;
		//fwrite($fp, 'amount1 passed' . "\n\n");
		if(number_format(trim($ipnData['transaction[1].amount'],'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ '),6,'.','')!==number_format($orderIpn->amount_2,6,'.',''))
			return false;
		//fwrite($fp, 'amount2 passed' . "\n\n");
		
		//fwrite($fp, 'validation passed' . "\n\n");
		//fclose($fp);
		return true;
		
		//number_format($number, 2, '.', '');
	}
	
	private function _update_ipnap_data($orderIpn, $ipnData)
	{
		//$fp = fopen('images/ipnap.log','a');
		//fwrite($fp, 'check status'.strtolower($orderIpn->status) . "\n\n");
		//fclose($fp);
		if (strtolower($orderIpn->status)!=='completed'){
			$orderIpn->status = $ipnData['status'];
			$orderIpn->receive_time = date('Y-m-d H:i:s');
			$orderIpn->sender_email = $ipnData['sender_email'];
			$orderIpn->pay_key = $ipnData['pay_key'];
			
			//$fp = fopen('images/ipnap.log','a');
			//fwrite($fp, 'save orderIpn' . "\n\n");
			//fclose($fp);
			if ($orderIpn->save())
				return true;
			else
				return false;
		}else{
			// already completed
			//$fp = fopen('images/ipnap.log','a');
			//fwrite($fp, 'status = complete' . "\n\n");
			//fclose($fp);

			return false;
		}
	}

	private function _validate_ipn_data($orderIpn, $ipnData)
	{
		//$fp = fopen('../logs/ipnap.log','a');
		//fwrite($fp, 'email'.$ipnData['business'] . "\n\n");
		//fwrite($fp, 'amt'.$ipnData['payment_gross'] . "\n\n");
		//fclose($fp);
		//if ($paypal->ipnData['payment_status']!=='Completed')
		//	return false;
		if ($ipnData['business']!==$orderIpn->receiver_email_1)
			return false;
		//if ($paypal->ipnData['invoice']!=='Completed')
		//	return false;
		if (number_format(trim($ipnData['payment_gross'],'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ '),6,'.','')!==number_format($orderIpn->amount_1,6,'.',''))
			return false;
		
		//fwrite($fp, 'validation passed' . "\n\n");
		
		//fwrite($fp, number_format(trim($ipnData['transaction[0].amount'],'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ '),6,'.','') . "\n\n");
		//fwrite($fp, number_format($orderIpn->amount_1,6,'.','') . "\n\n");
		//fwrite($fp, number_format(trim($ipnData['transaction[1].amount'],'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ '),6,'.','') . "\n\n");
		//fwrite($fp, number_format($orderIpn->amount_2,6,'.','') . "\n\n");
		//fwrite($fp, 'validation passed' . "\n\n");
		//fclose($fp);
		return true;
		
		//number_format($number, 2, '.', '');
	}
	
	private function _update_ipn_data($orderIpn, $ipnData)
	{
		//$fp = fopen('../logs/ipnap.log','a');
		//fwrite($fp, 'check status'.strtolower($orderIpn->status) . "\n\n");
		//fclose($fp);
		
		//mc_gross=11.99, invoice=20150704071325C6KVSDVSL, protection_eligibility=Ineligible, item_number1=, tax=0.00, item_number2=, payer_id=CMPT79NYXBBSJ, payment_date=22:13:59 Jul 03, 2015 PDT, payment_status=Completed, charset=windows-1252, mc_shipping=0.00, mc_handling=0.00, first_name=Guest, mc_fee=0.65, notify_version=3.8, custom=, payer_status=verified, business=julianjc82-co-kixify@yahoo.com.hk, num_cart_items=2, mc_handling1=0.00, mc_handling2=0.00, verify_sign=A.CSYz4u5IILQm5wM0J0JbJiIcEuARs4NtU4SZRZ5-Zj8QSF9fH6N7Ry, payer_email=julianjctest-bmguest@gmail.com, mc_shipping1=0.00, mc_shipping2=0.00, tax1=0.00, tax2=0.00, txn_id=7WV7478210469145R, payment_type=instant, last_name=Chan, item_name1=Converse 001 (size: 8), receiver_email=julianjc82-co-kixify@yahoo.com.hk, item_name2=Shipping, payment_fee=0.65, quantity1=1, quantity2=1, receiver_id=JSG7GNTMA7DM4, txn_type=cart, mc_gross_1=1.99, mc_currency=USD, mc_gross_2=10.00, residence_country=US, test_ipn=1, transaction_subject=, payment_gross=11.99, ipn_track_id=25125d567acf9, 

		if (strtolower($orderIpn->status)!=='completed'){
			$orderIpn->status = $ipnData['payment_status'];
			$orderIpn->receive_time = date('Y-m-d H:i:s');
			$orderIpn->sender_email = $ipnData['payer_email'];
			$orderIpn->pay_key = $ipnData['txn_id'];
			
			//$fp = fopen('images/ipnap.log','a');
			//fwrite($fp, 'save orderIpn' . "\n\n");
			//fclose($fp);
			if ($orderIpn->save())
				return true;
			else
				return false;
		}else{
			// already completed
			//$fp = fopen('images/ipnap.log','a');
			//fwrite($fp, 'status = complete' . "\n\n");
			//fclose($fp);

			return false;
		}
	}
	
	public function actionSuccess()
	{
		$this->render('/order/success');
	}

	public function actionFailure()
	{
		$this->render('/order/failure');
	}

	public function actionIndex()
	{

		$model = new Order('search');

		if(isset($_GET['Order']))
			$model->attributes=$_GET['Order'];

		$customer = Customer::model()->find('user_id=?',array(Yii::app()->user->id));
		$model->customer_id = $customer->customer_id;

		$this->render('index',array(
					'model'=>$model,
					));
	}

	public function actionAdmin()
	{
		$this->checkStore();
		//$this->layout = Shop::module()->adminLayout
		$store = Store::model()->find('user_id = :user_id ', array(
						':user_id' => Yii::app()->user->id));
		$model=new Order('search');
		$model->unsetAttributes();

		if(isset($_GET['Order']))
			$model->attributes=$_GET['Order'];
		$model->store_id=$store->id;
		$this->render('admin',array(
					'model'=>$model,
					));
	}
	
	public function actionList()
	{
		//$this->layout = Shop::module()->adminLayout;
		$customer = Customer::model()->find('user_id = :user_id ', array(
						':user_id' => Yii::app()->user->id));
						
		if($customer){
		$model=new Order('search');
		$model->unsetAttributes();
		
		if(isset($_GET['Order']))
			$model->attributes=$_GET['Order'];
		$model->customer_id=$customer->customer_id;
		$this->render('list',array(
					'model'=>$model,
					));
		}else{
			$this->redirect(array('/profile/profile/update'));
		}
	}

	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Order::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	private function _add_order_position($order, $product)
	{
		$position = new OrderPosition;
		$position->order_id = $order->order_id;
		$position->product_id = $product['product_id'];
		$position->amount = $product['amount'];
		$position->unit_price = $position->product->getPrice();
		$position->total_price = $position->unit_price * $position->amount;
		$position->specifications = @json_encode($product['Variations']);
		if(isset($product['Variations']))
			$position->variation_id = $product['Variations'][1][0];
		else
			$position->variation_id = '';
		$position->is_fee = 'N';
		//echo Yii::trace(CVarDumper::dumpAsString($position->store),'vardump');
		//echo Yii::trace(CVarDumper::dumpAsString($position->product),'vardump');
		$position->store_id = $position->product->store_id;
		//echo Yii::trace(CVarDumper::dumpAsString($position),'vardump');
		$position->save();
		
		return $position;
	}
	
	private function _add_order_shipping_position($order, $shippingOption)
	{
		$position = new OrderPosition;
		$position->order_id = $order->order_id;
		$position->product_id = 0;
		$position->amount = 1;
		$position->unit_price = ''.$shippingOption->fee;
		$position->total_price = ''.$shippingOption->fee;
		$position->specifications = 'null';
		$position->is_fee = 'Y';
		$position->fee_desc = $shippingOption->desc;
		$position->fee_type = 'shipping';
		$position->ship_country = $shippingOption->country;
		$position->store_id = $shippingOption->store_id;
		$position->save();
		//echo Yii::trace(CVarDumper::dumpAsString($position),'vardump');
		return $position;
	}
	
	public function _order_grid($data, $row){
		return $this->renderPartial('_order_grid', array('order'=>$data), true);
	}
}
