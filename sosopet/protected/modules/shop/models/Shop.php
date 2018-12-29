<?php

	class Shop {

		public static function getCountryChooser($form, $address, $htmlOptions=null) {
			$element = '';
			if (Yii::app()->language=='zh'){
			$countries = Shop::module()->validCountries_zh;
			}else{
			$countries = Shop::module()->validCountries;	
			}
			if($countries === null) {
				$element .= $form->labelEx($address,'country'); 
				$element .= $form->textField($address,'country',array(
							'size'=>45,'maxlength'=>45)); 
				$element .= $form->error($address,'country'); 
			} else if(is_array($countries)) {
				$element .= $form->labelEx($address,'country'); 
				$element .= $form->dropDownList($address, 'country', $countries, $htmlOptions);
				$element .= $form->error($address,'country'); 
			}

			return $element;
		}

		public static function getStateChooser($form, $address, $htmlOptions=null) {
			$element = '';
			$states = Shop::module()->validStates;
			if($states === null) {
				$element .= $form->labelEx($address,'state'); 
				$element .= $form->textField($address,'state',array(
							'size'=>45,'maxlength'=>45)); 
				$element .= $form->error($address,'state'); 
			} else if(is_array($states)) {
				$element .= $form->labelEx($address,'state'); 
				$element .= $form->dropDownList($address, 'state', $states, $htmlOptions);
				$element .= $form->error($address,'state'); 
			}

			return $element;
		}
		
		public static function confirmationMessage($order) {
			if(!$order instanceof Order)
				throw new CException(Shop::t('Error while sending confirmation message'));

			return strtr(Shop::module()->orderConfirmTemplate, array(
						'{title}' => $order->customer->address->title,
						'{firstname}' => $order->customer->address->firstname,
						'{lastname}' => $order->customer->address->lastname,
						'{order_id}' => $order->order_id));

		}

		public static function requiredFieldNote () {
			return Shop::t('Fields with {*} are required', array(
						'{*}' => '<span class="required">*</span>'));
		}

		public static function mailNotification ($order) {
			$email = Shop::module()->orderNotificationEmail;
			$from = Shop::module()->orderNotificationFromEmail;
			$reply = Shop::module()->orderNotificationReplyEmail;

			if($email !== null && $email !== false) {
				$header = ("From: " . $from . "\n");
				$header .= ("Reply-To: " . $reply . "\n");
				$header .= ("Return-Path: " . $reply . "\n");
				$header .= ("X-Mailer: PHP/" . phpversion() . "\n");
				$header .= ("X-Sender-IP: " . $_SERVER['REMOTE_ADDR'] . "\n");
				$header .= ("Content-type: text/html\n");

				mail($email,
						Shop::t('Order #{order_id} has been made in your Webshop', array(
								'{order_id}' => $order->order_id)), 
						Yii::app()->controller->renderPartial(
							'application.modules.shop.views.order.view_email', array(
								'model' => $order), true, false) 
						. '<br />' .
						Yii::app()->controller->createAbsoluteUrl(
							'//shop/order/view', array(
						'id' => $order->order_id)), $header);
			}
		}

	/* A wrapper for the Yii::log function. If no category is given, we
	 * use the ShopController as a fallback value.
	 * In addition to that, the message is being translated by Shop::t() */
		public static function log($message,
				$level = 'info',
				$category = 'application.modules.shop.controllers.ShopController') {
			if(Shop::module()->enableLogging) 
				return Yii::log(Shop::t($message), $level, $category);
		}

		public static function pricingInfo() {
			Shop::register('js/jquery.tools.min.js');
			Shop::register('css/shop.css');
			Yii::app()->clientScript->registerScript('tooltip', 
					"$('.price_information').tooltip(); ");

			echo '<p class="price_information">';
			echo Shop::t('All prices are including VAT') . '<br />';
			echo Shop::t('All prices excluding shipping costs');
			echo '</p>';
			echo '<div class="tooltip">';
				Yii::app()->controller->renderPartial('/shippingMethod/index'); 
			echo '</div>';

		}

/*		public function getCustomer() {
			$customer = false;
			$customer = Yii::app()->user->getState('customer_id');
				if(!$customer && !Yii::app()->user->isGuest)
					$customer = Customer::model()->find('user_id = :uid', array(
								':uid' => Yii::app()->user->id));

			return $customer;

		} */

		public static function priceFormat ($price) {
			$price = number_format($price,2);

			if(Yii::app()->language == 'de')
				$price = str_replace('.', ',', $price);

			//$price .= ' '.Shop::module()->currencySymbol;
			$price = Shop::module()->currencySymbol.' '.$price;
		
			return $price;
		}

		public static function pricePrefix() {
			if(Yii::app()->language == 'de')
				return 'ab';
			
			return 'from';
		}

		public static function getPaymentMethod() {
			return Yii::app()->user->getState('payment_method');
		}
		
		public static function getShippingMethodFromPaymentMethod($paymentMethod) {
			switch ($paymentMethod) {
			case 1:		// Courier Paypal
				return 1;
				break;
			case 2:		// Courier Cash
				return 1;
				break;
			case 3:		// In Person
				return 2;
				break;
			default:
				return 2;
				break;
		}
		}
		
		public static function getShippingMethod($costs = false) {
			if($shipping_method = Yii::app()->user->getState('shipping_method')) {
				$weight_total = Shop::getWeightTotal();
				$methods = ShippingMethod::model()->findAll('id = :id', array(
							':id' => $shipping_method));
				foreach($methods as $method) {
					$range = explode('-', $method->weight_range);
					if(isset($range[0]) 
							&& isset($range[1]) 
							&& is_numeric($range[0]) 
							&& is_numeric($range[1])) {
						if($range[0] <= $weight_total && $range[1] >= $weight_total)
							if($costs)
							return Shop::priceFormat($method->getPrice());
							else
							return $method;
					}
				}
			}
		}
		
		public static function getShippingCostsFromPaymentMethod($id = null) {
			//echo 'get'.$id;
			if($id) {
				$weight_total = Shop::getWeightTotal();
				$methods = ShippingMethod::model()->findAll('id = :id', array(
							':id' => Shop::getShippingMethodFromPaymentMethod($id)));
							
				foreach($methods as $method) {
					//echo 'find'.CVarDumper::dumpAsString($method);
					$range = explode('-', $method->weight_range);
					if(isset($range[0]) 
							&& isset($range[1]) 
							&& is_numeric($range[0]) 
							&& is_numeric($range[1])) {
						if($range[0] <= $weight_total && $range[1] >= $weight_total)
							return $method->getPrice();
					}
				}
			}
		}
		
		// for kix
		public static function getCartShippingMethods($selected=null){
			$cart = Shop::getCartContent();
			if($cart){
				$cartItem=current($cart);
				$shippingOption=Shop::getShippingMethodsByProductId($cartItem['product_id']);
				if($shippingOption){
					if($selected){
						$shippingOption->country=$selected;
						$selectedOption=$shippingOption->shippingOptions[$selected];
						if($selectedOption){
							$shippingOption->fee=$selectedOption['fee'];
							$shippingOption->desc=$selectedOption['desc'];
						}
					}elseif(Yii::app()->user->getState('shipping_option')) {
						$shippingOption->country=Yii::app()->user->getState('shipping_option');
						$selectedOption=$shippingOption->shippingOptions[$shippingOption->country];
						if($selectedOption){
							$shippingOption->fee=$selectedOption['fee'];
							$shippingOption->desc=$selectedOption['desc'];
						}
					}
				}
				//echo Yii::trace(CVarDumper::dumpAsString($cart),'vardump');
				//echo Yii::trace(CVarDumper::dumpAsString($shippingOption),'vardump');
				return $shippingOption;
			}
		}
		
		public static function getShippingMethodsByProductId($product_id) {
			$product = Products::model()->findByPk($product_id);
			$store = $product->store;
			return Shop::_getStoreShippingMethods($store);
		}
		
		public static function _getStoreShippingMethods($store)
		{
			$tempOptions = array();
			$shippingOption = new ShippingMethodForm;
			if(is_numeric($store->shipping_fee_us) && $store->ship_us){
				$tempOptions['us']=array('country'=>'us','fee'=>$store->shipping_fee_us,'desc'=>'Shipping Fee (US)',);
			}
			if(is_numeric($store->shipping_fee_ca) && $store->ship_ca){
				$tempOptions['ca']=array('country'=>'ca','fee'=>$store->shipping_fee_ca,'desc'=>'Shipping Fee (Canada)',);
			}
			if(is_numeric($store->shipping_fee_intl) && $store->ship_other){
				$tempOptions['other']=array('country'=>'other','fee'=>$store->shipping_fee_intl,'desc'=>'Shipping Fee (International)',);
			}
			$shippingOption->store_id=$store->id;
			$shippingOption->shippingOptions=$tempOptions;
			
			return $shippingOption;
		}

		public static function getCartContent() {
			if(is_string(Yii::app()->user->getState('cart')))
				return json_decode(Yii::app()->user->getState('cart'), true);
			else
				return Yii::app()->user->getState('cart');
		}

		public static function setCartContent($cart) {
			Yii::app()->user->setState('cart', json_encode($cart));
			return true;
		}

		public static function flushCart() {
			return Shop::setCartContent(array());	
		}

		public static function getWeightTotal() {
			$weight_total = 0;
			if($content = Shop::getCartContent())
				foreach($content as $product)  {
					$model = Products::model()->findByPk($product['product_id']);
					$weight_total += $model->getWeight(@$product['Variations'], @$product['amount']);
				}
			return $weight_total;
		}

		public static function getPriceTotal() {
			$price_total = 0;
			$tax_total = 0;
			foreach(Shop::getCartContent() as $product)  {
				$model = Products::model()->findByPk($product['product_id']);
				$price_total += $model->getPrice(@$product['Variations'],
						@$product['amount']);
				$tax_total += $model->getTaxRate(@$product['Variations'],
						@$product['amount']);
			}

			if($shipping_method = Shop::getShippingMethod()) {
				$price_total += $shipping_method->getPrice();
				$tax_total += ($shipping_method->getPrice() - $shipping_method->getAttribute('price')); 
			}

			$price_total = Shop::t('Price total: {total}', array(
						'{total}' => Shop::priceFormat($price_total),
						)); 
			$price_total .= '<br />';
			$price_total .= Shop::t('All prices are including VAT: {vat}', array(
						'{vat}' => Shop::priceFormat($tax_total))) . '<br />';
			$price_total .= Shop::t('All prices excluding shipping costs') . '<br />';

			return $price_total;
		}
		
		public static function getTotalProductPriceAmt(){
			$price_total = 0;
			$tax_total = 0;
			foreach(Shop::getCartContent() as $product)  {
				$model = Products::model()->findByPk($product['product_id']);
				$price_total += $model->getPrice(@$product['Variations'],
						@$product['amount']);
				$tax_total += $model->getTaxRate(@$product['Variations'],
						@$product['amount']);
			}
			
			return $price_total;
		}
		
		public static function getTotalPriceAmt(){
			$price_total = 0;
			$tax_total = 0;
			foreach(Shop::getCartContent() as $product)  {
				$model = Products::model()->findByPk($product['product_id']);
				$price_total += $model->getPrice(@$product['Variations'],
						@$product['amount']);
				$tax_total += $model->getTaxRate(@$product['Variations'],
						@$product['amount']);
			}

			if($shipping_method = Shop::getShippingMethod()) {
				$price_total += $shipping_method->getPrice();
				$tax_total += ($shipping_method->getPrice() - $shipping_method->getAttribute('price')); 
			}

			$shippingOption = Shop::getCartShippingMethods();
			if($shippingOption->country){
				$price_total += $shippingOption->fee;
			}
			
			return $price_total;
		}

		public static function register($file, $media = 'screen')
		{
			$url = Yii::app()->getAssetManager()->publish(
					Yii::getPathOfAlias('application.modules.shop.assets'));

			$path = $url . '/' . $file;
			if(strpos($file, 'js') !== false)
				return Yii::app()->clientScript->registerScriptFile($path);
			else if(strpos($file, 'css') !== false)
				return Yii::app()->clientScript->registerCssFile($path, $media);

			return $path;
		}

	public static function module()
	{
		if(isset(Yii::app()->controller)
			&& isset(Yii::app()->controller->module)
			&& Yii::app()->controller->module instanceof ShopModule)
			return Yii::app()->controller->module;
		elseif(Yii::app()->getModule('shop') instanceof ShopModule)
			return Yii::app()->getModule('shop');
		else
		{
			while (($parent=$this->getParentModule())!==null)
				if($parent instanceof shopModule)	
					return $parent;
		} 
	}


	public static function getCustomer() {
		if(!Yii::app()->user->isGuest) 
			if($customer = Customer::model()->find('user_id = :uid', array(
							':uid' => Yii::app()->user->id))) 
				return $customer;

		if($customer_id = Yii::app()->user->getState('customer_id')) 
				return Customer::model()->findByPk($customer_id);
		}

		public static function t($string, $params = array())
		{
			Yii::import('application.modules.shop.ShopModule');

			return Yii::t('ShopModule.shop', $string, $params);
		}
		/* set a flash message to display after the request is done */
		public static function setFlash($message) 
		{
			Yii::app()->user->setFlash('yiishop',Shop::t($message));
		}

		public static function hasFlash() 
		{
			return Yii::app()->user->hasFlash('yiishop');
		}

		/* retrieve the flash message again */
		public static function getFlash() {
			if(Yii::app()->user->hasFlash('yiishop')) {
				return Yii::app()->user->getFlash('yiishop');
			}
		}

		public static function renderFlash()
		{
			if(Yii::app()->user->hasFlash('yiishop')) {
				echo '<div class="alert">';
				echo Shop::getFlash();
				echo '</div>';
				//Yii::app()->clientScript->registerScript('fade',"
				//		setTimeout(function() { $('.alert').fadeOut('slow'); }, 5000);	
				//		"); 
			}
		}
		
		public static function validateQuantity()
		{
			$result=array();
			$result->status=true;
			$result->product_id=null;
			foreach(Shop::getCartContent() as $product)  {
				$model = Products::model()->findByPk($product['product_id']);
				if(@$product['amount']>$model->quantitiy){
					$result->status=false;
					$result->product_id=$product['product_id'];
				}
				return result;
			}
		}
	}
