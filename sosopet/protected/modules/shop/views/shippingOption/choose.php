<?php
if(!isset($customer))
	$customer = new Customer;

if($customer->address === NULL)
	$this->redirect(array('//shop/customer/create'));

	if(!isset($deliveryAddress))
if(isset($customer->deliveryAddress))
	$deliveryAddress = $customer->deliveryAddress;
else
	$deliveryAddress = new DeliveryAddress;

$form=$this->beginWidget('CActiveForm', array(
			'id'=>'customer-form',
			'action' => array('//shop/order/create'),
			'enableAjaxValidation'=>false,
			)); 
?>

<br>
<img src="<?php echo Yii::app()->baseUrl.'/images/shopping_chart-step2.jpg'; ?>" />

<h2> <?php echo Shop::t('Shipping options'); ?> </h2>

<h3> <?php echo Shop::t('Shipping address'); ?></h3>

<div class="current_address">
<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$customer->address,
			'htmlOptions' => array('class' => 'detail-view'),
			'attributes'=>array(
				'title',
				'firstname',
				'lastname',
				'street',
				'zipcode',
				'city',
				'country'
				),
			)); ?>
</div>
<br/>
<?php
echo CHtml::checkBox('toggle_delivery',
		$customer->deliveryAddress !== NULL, array(
			'style' => 'float: left')); 
echo CHtml::label(
		Shop::t('alternative delivery address'), 'toggle_delivery', array(
			'style' => 'cursor:pointer'));

?>

<div class="form">
<fieldset id="delivery_information" style="display: none;">
<div class="payment_address">

<div class="content">
	<h2><?php echo Shop::t('new shipping address'); ?></h2>
	<ul class="form-list">
	<li>
		<?php echo $form->labelEx($deliveryAddress,'title'); ?>
		<?php echo $form->dropDownList($deliveryAddress,'title',Shop::module()->titleOptions); ?>
	</li>

	<li>
		<?php echo $form->labelEx($deliveryAddress,'firstname'); ?>
		<?php echo $form->textField($deliveryAddress,'firstname',array('size'=>45,'maxlength'=>45)); ?>
	</li>

	<li>
		<?php echo $form->labelEx($deliveryAddress,'lastname'); ?>
		<?php echo $form->textField($deliveryAddress,'lastname',array('size'=>45,'maxlength'=>45)); ?>
	</li>

	<li>
		<?php echo $form->labelEx($deliveryAddress,'street'); ?>
		<?php echo $form->textField($deliveryAddress,'street',array('size'=>45,'maxlength'=>45)); ?>
	</li>

	<li>
		<?php echo $form->labelEx($deliveryAddress,'zipcode'); ?> 
		<?php echo $form->textField($deliveryAddress,'zipcode',array('size'=>10,'maxlength'=>45)); ?>
	</li>

	<li>
		<?php echo $form->labelEx($deliveryAddress,'city'); ?> 
		<?php echo $form->textField($deliveryAddress,'city',array('size'=>32,'maxlength'=>45)); ?>
	</li>

	<li>
		<?php echo Shop::getCountryChooser($form, $deliveryAddress,array('prompt'=>'--select--','onchange'=>'updateShippingOption()')); ?>	
	</li>
</div>

</div>
</fieldset>
<br />
<hr />  
<h3> <?php echo Shop::t('Shipping Method'); ?> </h3>
<p> <?php echo Shop::t('Choose your Shipping method'); ?> </p>

<?php

$shippingOption=Shop::getCartShippingMethods();
foreach($shippingOption->shippingOptions as $option){
	echo '<div class="row">';
	echo CHtml::radioButton("ShippingOption", $shippingOption->country==$option['country'], array(
				'value' => $option['country']));
	echo '<div class="float-left shipping_method">';
	echo CHtml::label($option['desc'].' - $'.$option['fee'].'@', 'ShippingOption');
	//echo CHtml::tag('p', array(), $option->description);
	//echo CHtml::tag('p', array(),
	//		Shop::t('Price: ') . Shop::priceFormat($option->getPrice()));
	echo '</div>';
	echo '</div>';
	echo '<div class="clear"></div>';
	//$i++;
}
?>



<?php
Yii::app()->clientScript->registerScript('toggle', "
		if($('#toggle_delivery').attr('checked'))
		$('#delivery_information').show();
		$('#toggle_delivery').click(function() { 
			$('#delivery_information').toggle(500);
			});
		");
?>

<div class="row buttons">
<?php
echo CHtml::submitButton(Shop::t('Continue'),array('id'=>'next'));
?>
</div>
</div>
<?php $this->endWidget(); ?>

<script language="JavaScript" type="text/javascript">
<!--
	function updateShippingOption(){
		var targetValue="intl";
		if($('#DeliveryAddress_country').val()=="<?php echo Shop::module()->country_us; ?>"){
			targetValue="us";
		}else if($('#DeliveryAddress_country').val()=="<?php echo Shop::module()->country_ca; ?>"){
			targetValue="ca";
		}else{
			targetValue="intl";
		}
		var items=document.getElementsByName("ShippingOption");
		for (var i = 0; i < items.length; i++) {
			if (items[i].value == targetValue) {
				items[i].checked = true;
			}else{
				items[i].checked = false;
			}
		}
	}
	
-->
</script>
