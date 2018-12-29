<?php

class ShoppingCartController extends Controller
{
	public function filters()
	{
		return array(
				'accessControl',
				);
	}	
	
	public function accessRules() {
		return array(
				array('allow',
					'actions'=>array('view', 'updateVariation', 'getPriceSingle', 'getPriceTotal', 'getProductPriceTotal', 'getShippingCosts', 'updateAmount', 'updateShipping'),
					'users' => array('@'),
					),
				array('allow',
					'actions'=>array('admin','delete','create','quickCreate'),
					'users' => array('@'),
					),
				array('deny',  // deny all other users
					'users'=>array('*'),
					),
				);
	}
	
	public function actionView()
	{
		$cart = Shop::getCartContent();
		//echo Yii::trace(CVarDumper::dumpAsString($cart),'vardump');
		$shoppingCart = new ShoppingCartForm;
		//echo Yii::trace(CVarDumper::dumpAsString($shoppingCart),'vardump');
		$shoppingCart->cart=$cart;
		//echo Yii::trace(CVarDumper::dumpAsString($shoppingCart),'vardump2');
		//$shoppingCart->attributes = array('cart'=>$cart);
		//echo Yii::trace(CVarDumper::dumpAsString($shoppingCart),'vardump3');
		$shoppingCart->validate();
		$this->render('view',array(
						'products'=>$cart,
						'shoppingCart'=>$shoppingCart,
						));
	}

	public function beforeAction($action) {
		$this->layout = Shop::module()->layout;
		return parent::beforeAction($action);
	}

	public function actionUpdateVariation() {
		if(Yii::app()->request->isAjaxRequest && isset($_POST)) {
			$cart = Shop::getCartContent();
			$pieces = explode('_', key($_POST));

			$position = $pieces[1];
			$variation = $pieces[2];
			$new_value = array();
			$new_value[] = $_POST[key($_POST)];

			$cart[$position]['Variations'][$variation] = $new_value;

			if(Shop::setCartContent($cart)) {
				$product = Products::model()->findByPk($cart[$position]['product_id']);
				echo Shop::priceFormat(
						@$product->getPrice($cart[$position]['Variations'], $cart[$position]['amount'] ));
			} else throw new CHttpException(500);
		}
	}

	public function actionGetPriceSingle($position) {
		$cart = Shop::getCartContent();
		$product_id = $cart[$position]['product_id'];
		if($product = Products::model()->findByPk($product_id))
			if(Yii::app()->request->isAjaxRequest)
				echo Shop::priceFormat(
						$product->getPrice($cart[$position]['Variations'], 1));
			else
				return Shop::priceFormat(
						$product->getPrice($cart[$position]['Variations'], 1));
	}

	public function actionGetProductPriceTotal() {
		echo Shop::priceFormat(Shop::getTotalProductPriceAmt());
	}
	
	public function actionGetPriceTotal() {
		//echo Shop::getPriceTotal();
		echo Shop::priceFormat(Shop::getTotalPriceAmt());
	}

	public function actionGetShippingCosts() {
		echo Shop::getShippingMethod(true);
		//echo Shop::priceFormat(Shop::getCartShippingMethods()->fee);
	}

	public function actionUpdateShipping() {
		if(Yii::app()->request->isAjaxRequest && isset($_POST)) {
			$paymentMethod = PaymentMethod::model()->findByPk($_POST['PaymentMethod']['id']);
			Yii::app()->user->setState('payment_method', $_POST['PaymentMethod']['id']);
			Yii::app()->user->setState('shipping_method', Shop::getShippingMethodFromPaymentMethod($paymentMethod->id));			
			//echo 'input'. $_POST['PaymentMethod']['id'];
			//echo 'find'. $paymentMethod->id;
			if ($paymentMethod)
				echo Shop::getShippingCostsFromPaymentMethod($paymentMethod->id);
			else
				throw new CHttpException(500);
		}
	}
	
	public function actionUpdateAmount() {
		$cart = Shop::getCartContent();

		foreach($_GET as $key => $value) {
			if(substr($key, 0, 7) == 'amount_') {
				if($value == '')
					return true;
				if (!is_numeric($value) || $value <= 0)
					throw new CException('Wrong amount');
				$position = explode('_', $key);
				$position = $position[1];
				
				if(isset($cart[$position]['amount']))
					$cart[$position]['amount'] = $value;
					$product = Products::model()->findByPk($cart[$position]['product_id']);
					echo Shop::priceFormat(
							@$product->getPrice($cart[$position]['Variations'], $value));
					return Shop::setCartContent($cart);
			}	
		}

}


	// Add a new product to the shopping cart
	public function actionCreate()
	{
		
		if(!is_numeric($_POST['amount']) || $_POST['amount'] <= 0) {
			Shop::setFlash(Shop::t('Illegal quantity given'));
			$this->redirect(array( 
							'//shop/products/view', 'id' => $_POST['product_id']));
		}
		
		if(isset($_POST['Variations']))
			foreach($_POST['Variations'] as $key => $variation) {
			
				$specification = ProductSpecification::model()->findByPk($key);
				if($specification->required && $variation[0] == '') {
					Shop::setFlash(Shop::t('Please select a {specification}', array(
									'{specification}' => $specification->title)));
					$this->redirect(array(
								'//shop/products/view', 'id' => $_POST['product_id']));
				}

			}

		if(isset($_FILES)) {
			foreach($_FILES as $variation) {
				$target = Shop::module()->uploadedImagesFolder . '/' . $variation['name'];
				if($variation['tmp_name'] == '') {
					Shop::setFlash(Shop::t('Please select a image from your hard drive'));
					$this->redirect(array('//shop/shoppingCart/view'));
				}
					
				if(move_uploaded_file($variation['tmp_name'], $target))
					$_POST['Variations']['image'] = $target;
			}
		}
		
		$cart = Shop::getCartContent();

		// remove potential clutter
		if(isset($_POST['yt0']))
			unset($_POST['yt0']);
		if(isset($_POST['yt1']))
			unset($_POST['yt1']);

		$cart[] = $_POST;
		
		// validate cart
		
	
		Shop::setCartcontent($cart);
		Shop::setFlash(Shop::t('The product has been added to the shopping cart'));
		$this->redirect(array('//shop/shoppingCart/view'));
	}
	
	public function actionQuickCreate()
	{
		$cart = Shop::getCartContent();
		//echo Yii::trace(CVarDumper::dumpAsString(Yii::app()->request->csrfToken ),'vardump');
		$_GET[Yii::app()->request->csrfTokenName]=Yii::app()->request->csrfToken;
		$_GET['amount']='1';
		// set default variation
		$product = Products::model()->findByPk($_GET['product_id']);
		if($product){
			if($product->variations){
				$_GET['Variations'][1][0] = current($product->variations)->id;
			}
		}
		$cart[] = $_GET;
		
		//echo Yii::trace(CVarDumper::dumpAsString($cart),'vardump');
	
		Shop::setCartcontent($cart);
		Shop::setFlash(Shop::t('The product has been added to the shopping cart'));
		$this->redirect(array('//shop/shoppingCart/view'));
	}

	public function actionDelete($id)
	{
		$id = (int) $id;
		$cart = json_decode(Yii::app()->user->getState('cart'), true);

		unset($cart[$id]);
		Yii::app()->user->setState('cart', json_encode($cart));

			$this->redirect(array('//shop/shoppingCart/view'));
	}

	public function actionIndex()
	{
		if(isset($_SESSION['cartowner'])) {
			$carts = ShoppingCart::model()->findAll('cartowner = :cartowner', array(':cartowner' => $_SESSION['cartowner']));

			$this->render('index',array( 'carts'=>$carts,));
		} 
	}

	public function actionAdmin()
	{
		$model=new ShoppingCart('search');
		if(isset($_GET['ShoppingCart']))
			$model->attributes=$_GET['ShoppingCart'];
			$model->cartowner = Yii::app()->User->getState('cartowner');

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=ShoppingCart::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='shopping cart-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	private function _validate_quantity($cartItem, $quantity)
	{
		
	}
	
	private function _validate_store($cartItem, $prev_store_id)
	{
		
	}
	
	private function _validate_cart($cart)
	{
		//reorganize cart by each product_id
		//echo Yii::trace(CVarDumper::dumpAsString($cart),'vardump');
		$tempCart=array();
		foreach($cart as $c){
			$product_id=$c['product_id'];
			$amount=$c['amount'];
			//$this->_validate_store($c, $prev_store_id);
			if(array_key_exists($product_id,$tempCart)){
				//$tempCart[$product_id]=array('product_id'=>$product_id,'amount'=>$amount,);
				$tempCart[$product_id]['amount']=$tempCart[$product_id]['amount']+$amount;
			}else{
				$tempCart[$product_id]=array('product_id'=>$product_id,'amount'=>$amount,);
			}
		}
		//echo Yii::trace(CVarDumper::dumpAsString($tempCart),'vardump');
		//do validation
		foreach($tempCart as $c){
			$product = Products::model()->findByPk($c['product_id']);
			if($product){
				if($product->quantity<$c['amount'])
					throw new CException('Not enough stock');
			}else{
			}
		}
	}
}
