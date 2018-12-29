<?php echo $form->errorSummary(array($customer, $deliveryAddress, $BillingAddress)); ?>
<!-- - - - - - - - - - - - - - Customer - - - - - - - - - - - - - - - - -->
<section class="section_offset">
	<h3>Customer</h3>
	<div class="theme_box">
			<ul>
				<li class="row">
					<div class="col-sm-6">
						<?php echo $form->labelEx($customer,'email'); ?>
						<?php echo $form->textField($customer,'email',array('size'=>45,'maxlength'=>45)); ?>
					</div><!--/ [col] -->
					<div class="col-sm-6">
						<?php echo $form->labelEx($customer,'phone'); ?>
						<?php echo $form->textField($customer,'phone',array('size'=>45,'maxlength'=>45)); ?>
					</div><!--/ [col] -->
				</li>
			</ul>
	</div>
</section>
<!-- - - - - - - - - - - - - - End of Customer - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - Payment Method - - - - - - - - - - - - - - - - -->
<section class="section_offset">
	<h3>Payment Method</h3>
	<div class="theme_box">
		<?php
		/*
			echo CHtml::radioButton('PaymentMethod', false, array(
				'value'=>'1',
				'name'=>'PaymentMethod',
				'id'=>'PaymentMethod_1',
				'uncheckValue'=>null
			));
			echo CHtml::label('PayPal', 'PaymentMethod_1');
			echo $form->radioButton($paymentMethod, 'paymentMethod', array(
				'value'=>2,
				'id'=>'PaymentMethod_2',
				'uncheckValue'=>null
			));
			echo CHtml::label('PayPal2', 'PaymentMethod_2');
			*/
			// retrieve the models from db
			$paymentMethods = PaymentMethod::model()->findAll();
			 
			// format models as $key=>$value with listData
			$paymentMethodList = CHtml::listData($paymentMethods, 'id', 'title');
			
			echo $form->radioButtonList($paymentMethod, 'id',
					$paymentMethodList,
					array(
						//'labelOptions'=>array('style'=>'display:inline'), // add this code
						'separator'=>'  ',
				));
			//echo CHtml::radioButtonList('payment_method',isset($paymentMethod)?$paymentMethod:'',$paymentMethodList, array( 'separator' => "  ")); 
		?>
	</div>
</section>
<!-- - - - - - - - - - - - - - End of Payment Method - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - Billing information - - - - - - - - - - - - - - - - -->
<section id="billingInfo" class="section_offset" style="<?php echo $skipAddress?'display:none':''; ?>">
	<h3>Billing Information</h3>
	<div class="theme_box">
		<!-- <form class="type_2"> -->
			<ul>
				<li class="row">	
					<div class="col-sm-6">
						<?php echo $form->labelEx($BillingAddress,'firstname'); ?>
						<?php echo $form->textField($BillingAddress,'firstname',array('size'=>45,'maxlength'=>255)); ?>
					</div><!--/ [col] -->
					<div class="col-sm-6">
						<?php echo $form->labelEx($BillingAddress,'lastname'); ?>
						<?php echo $form->textField($BillingAddress,'lastname',array('size'=>45,'maxlength'=>255)); ?>
					</div><!--/ [col] -->
				</li><!--/ .row -->
				<li class="row">
					<div class="col-sm-6">
						<?php echo $form->labelEx($BillingAddress,'company'); ?>
						<?php echo $form->textField($BillingAddress,'company',array('size'=>45,'maxlength'=>255)); ?>
					</div><!--/ [col] -->
				</li><!--/ .row -->
				<li class="row">	
					<div class="col-xs-12">
						<?php echo $form->labelEx($BillingAddress,'street'); ?>
						<?php echo $form->textField($BillingAddress,'street',array('size'=>45,'maxlength'=>255)); ?>
					</div><!--/ [col] -->
				</li><!-- / .row -->
				<li class="row">
					<div class="col-sm-6">
						<?php echo $form->labelEx($BillingAddress,'city'); ?> 
						<?php echo $form->textField($BillingAddress,'city',array('size'=>32,'maxlength'=>45)); ?>
					</div><!--/ [col] -->
					<div class="col-sm-6">
						<?php echo Shop::getStateChooser($form, $BillingAddress); ?>
					</div><!--/ [col] -->
				</li><!--/ .row -->
				<li class="row">
					<div class="col-sm-6">
						<?php echo $form->labelEx($BillingAddress,'zipcode'); ?> 
						<?php echo $form->textField($BillingAddress,'zipcode',array('size'=>10,'maxlength'=>45)); ?>
					</div><!--/ [col] -->
					<div class="col-sm-6">
						<?php 
							//echo Shop::getCountryChooser($form, $BillingAddress,array('prompt'=>'--select--','onchange'=>'updateShippingOption()')); 
							echo Shop::getCountryChooser($form, $BillingAddress,array('prompt'=>'--select--')); 
						?>
					</div><!--/ [col] -->
				</li><!--/ .row -->
				<li class="row">
					<div class="col-sm-6">
						<?php echo $form->labelEx($BillingAddress,'phone'); ?> 
						<?php echo $form->textField($BillingAddress,'phone',array('size'=>10,'maxlength'=>45)); ?>
					</div><!--/ [col] -->
				</li><!--/ .row -->
				<li class="row">
					<div class="col-xs-12">
						<input name="sameAsShip" id="sameAsShip" type="checkbox" value="1" onclick="toggleBilling();" <?php if($sameAsShip=='1') echo 'CHECKED'; ?> />  Same as shipping address.
					</div><!--/ [col] -->
				</li><!--/ .row -->
			</ul>
		<!--</form>-->
	</div>
</section><!--/ .section_offset -->
<!-- - - - - - - - - - - - - - End of billing information - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - Shipping information - - - - - - - - - - - - - - - - -->
<section id="shippingInfo" class="section_offset" style="<?php echo $skipAddress?'display:none':''; ?>">
	<h3>Shipping Information</h3>
	<div class="theme_box">
		<!-- <form class="type_2">-->
			<ul>
				<li class="row">					
					<div class="col-sm-6">
						<?php echo $form->labelEx($deliveryAddress,'firstname'); ?>
						<?php echo $form->textField($deliveryAddress,'firstname',array('size'=>45,'maxlength'=>255)); ?>
					</div><!--/ [col] -->
					<div class="col-sm-6">
						<?php echo $form->labelEx($deliveryAddress,'lastname'); ?>
						<?php echo $form->textField($deliveryAddress,'lastname',array('size'=>45,'maxlength'=>255)); ?>
					</div><!--/ [col] -->
				</li><!--/ .row -->
				<li class="row">
					<div class="col-sm-6">
						<?php echo $form->labelEx($deliveryAddress,'company'); ?>
						<?php echo $form->textField($deliveryAddress,'company',array('size'=>45,'maxlength'=>255)); ?>
					</div><!--/ [col] -->
				</li><!--/ .row -->
				<li class="row">
					<div class="col-xs-12">
						<?php echo $form->labelEx($deliveryAddress,'street'); ?>
						<?php echo $form->textField($deliveryAddress,'street',array('size'=>45,'maxlength'=>255)); ?>
					</div><!--/ [col] -->
				</li><!--/ .row -->
				<li class="row">
					<div class="col-sm-6">						
						<?php echo $form->labelEx($deliveryAddress,'city'); ?> 
						<?php echo $form->textField($deliveryAddress,'city',array('size'=>32,'maxlength'=>45)); ?>
					</div><!--/ [col] -->
					<div class="col-sm-6">
						<?php echo Shop::getStateChooser($form, $deliveryAddress); ?>
					</div><!--/ [col] -->
				</li><!--/ .row -->
				<li class="row">
					<div class="col-sm-6">
						<?php echo $form->labelEx($deliveryAddress,'zipcode'); ?> 
						<?php echo $form->textField($deliveryAddress,'zipcode',array('size'=>10,'maxlength'=>45)); ?>
					</div><!--/ [col] -->
					<div class="col-sm-6">
						<?php 
							//echo Shop::getCountryChooser($form, $deliveryAddress,array('prompt'=>'--select--','onchange'=>'updateShippingOption()')); 
							echo Shop::getCountryChooser($form, $deliveryAddress,array('prompt'=>'--select--',)); 
						?>
					</div><!--/ [col] -->
				</li><!--/ .row -->
				<li class="row">
					<div class="col-sm-6">
						<?php echo $form->labelEx($deliveryAddress,'phone'); ?> 
						<?php echo $form->textField($deliveryAddress,'phone',array('size'=>10,'maxlength'=>45)); ?>
					</div><!--/ [col] -->
				</li><!--/ .row -->
			</ul>
		<!-- </form>-->
		<a href="#" class="button_grey middle_btn">Use Billing Address</a>
	</div>
</section><!--/ .section_offset -->
<!-- - - - - - - - - - - - - - End of shipping information - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - Order review - - - - - - - - - - - - - - - - -->

<section class="section_offset">
	<div class="table_wrap">
		<table class="table_type_1 order_review">
			<tfoot>
				<tr>
					<td colspan="4" class="bold">Subtotal</td>
					<td class="total"><?php echo Shop::priceFormat(Shop::getTotalProductPriceAmt()); ?></td>
				</tr>
				<tr>	
					<td colspan="4" class="bold">Shipping &amp; Heading (Flat Rate - Fixed)
					<div id="shipping_msg" name="shipping"></div>
					<!-- <a class="button_grey middle_btn" href="javascript:updateShippingOption();" id="calc" title="Calculate Shipping">Calculate Shipping</a>-->
					</td>
					<td class="total" id="shipping_fee" name="shipping_fee">
					<?php
						$shippingOption=Shop::getCartShippingMethods();
						//echo Shop::priceFormat($shippingOption->fee);
						echo Shop::getShippingMethod(true);
						//echo Yii::app()->user->getState('shipping_method');
					?>
					</td>
				</tr>
				<tr>
					<td colspan="4" class="grandtotal">Grand Total</td>
					<td class="grandtotal" id="grand_total" name="grand_total"><?php echo Shop::priceFormat(Shop::getTotalPriceAmt()); ?></td>
				</tr>
			</tfoot>
		</table>
	</div><!--/ .table_wrap -->
	<footer class="bottom_box on_the_sides">
		<div class="left_side v_centered">
			<span>Forgot an item?</span>
			<a href="<?php echo Yii::app()->createUrl('//shop/shoppingCart/view');?>" class="button_grey middle_btn">Edit Your Cart</a>
		</div>
		<div class="right_side">
			<input class="button_blue middle_btn" type="submit" value="Place Order">
		</div>
	</footer>
</section>
<!-- - - - - - - - - - - - - - End of order review - - - - - - - - - - - - - - - - -->
<script>
	function toggleBilling(){
		if($('#sameAsShip').prop("checked"))
			$('#billingAddr_section').hide();
		else
			$('#billingAddr_section').show();
	}
</script>
<?php
	// assume only paypal for payment method
	//foreach(PaymentMethod::model()->findAll() as $method) {
	//	echo CHtml::hiddenField('PaymentMethod', $method->id);
	//}
?>
<?php echo $form->hiddenField($customer, 'user_id', array('value'=> Yii::app()->user->id)); ?>
<?php
	$shippingOption=Shop::getCartShippingMethods();
	echo CHtml::hiddenField('ShippingOption',$shippingOption->country);
	foreach($shippingOption->shippingOptions as $option){
		echo CHtml::hiddenField('ShippingFee_'.$option['country'],$option['fee']);
	}
	echo CHtml::hiddenField('TotalProductPrice',Shop::getTotalProductPriceAmt());
?>
<?php
Yii::app()->clientScript->registerScript('updateShipping', "
		$('input[name^=PaymentMethod]').click(function() {
			//alert($(this).val());
			hideShowAddress($(this).val());
			$.ajax({
				type: 'POST',
				url:'".$this->createUrl('//shop/shoppingCart/updateShipping')."',
				data: $(this),
				success: function(result) {
				shippingFee=Number(result);
				totalPrice=Number($('#TotalProductPrice').val())+Number(result);
				$('#shipping_fee').html('$ '+numberWithCommas(shippingFee));
				$('#grand_total').html('$ '+numberWithCommas(totalPrice));
				},
				error: function() {
				$('#shipping_fee').css('background-color', 'red');
				},

				});
		});
		"
);
?>
<script language="JavaScript" type="text/javascript">
<!--
	function updateShippingOption(){
		var targetValue="other";
		var totalPrice=0;
		var shippingFee=0;
		$('#shipping_msg').html('');
		if($('#DeliveryAddress_country').val()=="<?php echo Shop::module()->country_us; ?>"){
			targetValue="us";
		}else if($('#DeliveryAddress_country').val()=="<?php echo Shop::module()->country_ca; ?>"){
			targetValue="ca";
		}else{
			targetValue="other";
		}

		if($('#ShippingFee_'+targetValue).length > 0){
			$('#ShippingOption').val(targetValue);
			shippingFee=Number($('#ShippingFee_'+targetValue).val());
			totalPrice=Number($('#TotalProductPrice').val())+Number($('#ShippingFee_'+targetValue).val());
			$('#shipping_fee').html('$ '+numberWithCommas(shippingFee));
			$('#grand_total').html('$ '+numberWithCommas(totalPrice));
		}else{
			$('#shipping_msg').html("The store does not ship to the country you have selected in your delivery information. Please remove the product from your cart or change your shipping address.");
			$('#shipping_fee').html('$ '+numberWithCommas(0.00));
			$('#grand_total').html('$ '+numberWithCommas(Number($('#TotalProductPrice').val())));
		}
	}
	
	function numberWithCommas(x) {
		return currencyFormatted(x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	}
	
	function currencyFormatted(amount)
	{
		var i = parseFloat(amount);
		if(isNaN(i)) { i = 0.00; }
		var minus = '';
		if(i < 0) { minus = '-'; }
		i = Math.abs(i);
		i = parseInt((i + .005) * 100);
		i = i / 100;
		s = new String(i);
		if(s.indexOf('.') < 0) { s += '.00'; }
		if(s.indexOf('.') == (s.length - 2)) { s += '0'; }
		s = minus + s;
		return s;
	}
	
	function hideShowAddress(val){
		hide = true;
		switch(val) {
			case '1':
				hide = false;
				break;
			case '2':
				hide = false;
				break;
			case '3':
				hide = true;
				break;
			default:
				hide = true;
		}
		if(hide){
			//alert('hide');
			$('#billingInfo').hide();
			$('#shippingInfo').hide();
		}else{
			//alert('show');
			$('#billingInfo').show();
			$('#shippingInfo').show();
		}
	}
-->
</script>
<!-- shipping-form -->
