<div class="secondary_page_wrapper">
<div class="container">
<?php 
	$this->widget('application.components.widgets.BreadcrumbsWidget',array(
								'items'=>array(
												array('description'=>'Home', 'href'=>Yii::app()->createUrl('/site/index'),),
												array('description'=>'Checkout'),
											)
							)
						);
	Shop::renderFlash();
?>
<?php
$form=$this->beginWidget('CActiveForm', array(
		'id'=>'customer-form',
		'action' => Yii::app()->createUrl('//shop/order/review'),
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('class'=>'type_2',),
	)); 
?>
<?php
if(Shop::getCartContent() == array())
	return false;

	// If the customer is not passed over to the view, we assume the user is 
	// logged in and we fetch the customer data from the customer table
	echo Yii::trace(CVarDumper::dumpAsString(isset($customer)),'vardump');
if(!isset($customer))
	$customer = Shop::getCustomer();
	$this->renderPartial('application.modules.shop.views.customer._subform', array(
				'form' => $form,
				'customer' => $customer,
				'paymentMethod' => $paymentMethod,
				'shippingMethod' => $shippingMethod,
				'deliveryAddress' => $deliveryAddress,
				'BillingAddress' => $BillingAddress,
				'sameAsShip' => $sameAsShip,
				'skipAddress' => $skipAddress,
				));
?>
<?php $this->endWidget(); ?>
</div>
</div>
