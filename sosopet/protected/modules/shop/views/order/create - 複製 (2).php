<section class="content-wrapper">
	<div class="content-container container">
		<div class="col-1-layout">
<div class="center"><img src="<?php echo Yii::app()->baseUrl.'/images/shopping_chart-step2.jpg'; ?>" /></div>
<?php

Shop::renderFlash();
$form=$this->beginWidget('CActiveForm', array(
		'id'=>'customer-form',
		'action' => Yii::app()->createUrl('//shop/order/review'),
		'enableAjaxValidation'=>false,
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
				'deliveryAddress' => $deliveryAddress,
				'BillingAddress' => $BillingAddress,
				'sameAsShip' => $sameAsShip,
				));
echo '<br />';


?>
<?php $this->endWidget(); ?>
</br></br>
		</div>
		<div class="clearfix"></div>
		 <br>
	</div>
</section>
