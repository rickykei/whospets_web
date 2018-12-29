<section class="content-wrapper">
	<div class="content-container container">
		<div>
<?php 
echo '<br><img src="'.Yii::app()->baseUrl.'/images/shopping_chart-step3.jpg" />';
Shop::renderFlash();
$form=$this->beginWidget('CActiveForm', array(
		'id'=>'customer-form',
		'action' => Yii::app()->createUrl('//shop/order/confirm'),
		'enableAjaxValidation'=>false,
	)); 
?>
<script language="JavaScript" type="text/javascript">
<!--
function submit()
{
	$('#<?php echo $form->id ?>').submit();
}
-->
</script>
<?php

if(Shop::getCartContent() == array())
	return false;

$this->renderPartial('application.modules.shop.views.shoppingCart._cart_view'); 


	// If the customer is not passed over to the view, we assume the user is 
	// logged in and we fetch the customer data from the customer table
if(!isset($customer))
	$customer = Shop::getCustomer();
	$this->renderPartial('application.modules.shop.views.customer._confirm_view', array(
				'model' => $customer,
				'hideAddress' => true,
				'hideEmail' => true));
echo '<br />';
echo '<hr />';


echo '<h3>'.Shop::t('Please add additional comments to the order here').'</h3>'; 
echo CHtml::textArea('Order[Comment]',
	@Yii::app()->user->getState('order_comment'), array(
		'class' => 'order_comment'));

echo '<br /><br />';

//echo '<hr />';

//$this->renderPartial(Shop::module()->termsView);

?>

<hr>
<div class="shopping-cart-totals">
	<div class="subtotal-row"><div class="left">Subtotal</div><div class="right"><?php echo Shop::priceFormat(Shop::getTotalProductPriceAmt()); ?></div></div>
	<div class="subtotal-row"><div class="left">Shipping Fee</div><div class="right">
	<?php
		$shippingOption=Shop::getCartShippingMethods();
		echo Shop::priceFormat($shippingOption->fee);
	?>
	</div></div>
	<div class="grand-row"><div class="left">Grand  Total</div><div class="right"><?php echo Shop::priceFormat(Shop::getTotalPriceAmt()); ?></div></div>
	<ul class="checkout-types">
	<li><a href="javascript:submit();" class="colors-btn" title="Submit Order">Submit Order</a></li>
	</ul>
</div>
<div class="shopping-cart-collaterals">
 <li><a href="<?php echo Yii::app()->createUrl('//shop/order/create');?>" class="colors-btn" id="back" title="Back">Back</a></li>
</div>
<div class="clearfix"></div>
<br>
<?php $this->endWidget(); ?>
</br></br>
		</div>
		<div class="clearfix"></div>
		 <br>
	</div>
</section>