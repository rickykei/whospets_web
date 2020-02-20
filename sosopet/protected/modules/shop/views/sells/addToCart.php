<div class="model-block">
<?php
//echo Shop::renderFlash();

$form=$this->beginWidget('CActiveForm', array(
								'action'=>Yii::app()->request->baseUrl.'/shop/shoppingCart/create', 
								'id' => 'addtocart_'.$product->product_id, 
								'method'=>'POST', 
								)
							);
echo CHtml::hiddenField('product_id', $product->product_id);
?>
<script language="JavaScript" type="text/javascript">
<!--
function submit()
{
	$('#<?php echo $form->id ?>').submit();
}
-->
</script>
<div class="add-to-cart-box">
	<span class="qty-box">
		<label for="qty">Qty:</label>
		<?php 
		//echo CHtml::activeNumberField($product,'quantity',array()); 
		echo CHtml::textField('amount', 1, array('size' => 3));
		?>
		
	</span>
	<?php
	if($variations = $product->getVariations()) {
	$i = 0;
	foreach($variations as $variation) {
		$i++;
		$field = "Variations[{$variation[0]->specification_id}][]";
		//echo '<br/><br/><div class="product_variation product_variation_'.$i.'">';
		echo '<span class="qty-box">';
		echo '<label>';
		echo $variation[0]->specification->title;
		//echo CHtml::label($variation[0]->specification->title,
		//		$field, array(
		//			'class' => 'lbl-header'));
		echo ':</label>';
		//if($variation[0]->specification->required)
		//	echo ' <span class="required">*</span>';

		//echo  '<br />';
		if($variation[0]->specification->input_type == 'textfield') {
			echo CHtml::textField($field);
		} else if ($variation[0]->specification->input_type == 'select'){
			// If the specification is required, preselect the first field. Otherwise
			// let the customer choose which one to pick
			//echo CHtml::radioButtonList($field,
			//		$variation[0]->specification->required ? $variation[0]->id : null,
			//		ProductVariation::listData($variation));
			echo CHtml::dropDownList($field,
					$variation[0]->specification->required ? $variation[0]->id : null,
					ProductVariation::listSimpleVar($variation));
		} else if ($variation[0]->specification->input_type == 'image'){
			echo CHtml::fileField($field);
		}

		//echo '</div><br/>';
		echo '</span>';
		if($i % 2 == 0)
			echo '<div style="clear: both;"></div>';
	}

}
	?>
	<button class="form-button" title="Add to Cart" onclick="submit();"><span>Add to Cart</span></button>
	<ul class="add-to-box">
		<li><a href="<?php echo Yii::app()->createUrl('/shop/wishlist/update',array('product_id' => $product->product_id)); ?>" title="Add to Wishlist" class="add-wishlist">Add to Wishlist</a></li>
		<li><a href="#" title="Add to Compare" class="add-compare">Add to Compare</a></li>
	</ul>
	
	<ul class="add-to-box">
		<li><a class="test-popup-link size-guide ajax" href="<?php echo Yii::app()->baseUrl.'/';?>images/size_chart.jpg" title="Size Guide">Size Guide</a></li>
		<?php if(!Yii::app()->user->isGuest){ ?>
		<li><a href="#" title="Contact Seller" onclick="$('#chatdialog div.shipping-form-container form div.captcha a').trigger('click'); $('#chatdialog').dialog('open'); return false;" class="email-friend">Contact Seller</a></li>
		<?php } ?>
	</ul>
</div>
<?php
$this->endWidget();
?>

<?php
	// Dialog for chat
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		'id'=>'chatdialog',
		// additional javascript options for the dialog plugin
		'options'=>array(
			'title'=>'Write new message to '.$product->store->user->profile->firstname.' '.$product->store->user->profile->lastname,
			'width'=> 'auto',
			'height' => 'auto',
			'autoOpen'=>false,
			'modal'=>true,
			'buttons' => array(
							'Send Message'=>'js:function(){sendMessage()}',
							'Cancel'=>'js:function(){ $(this).dialog("close");}',
						),
		),
	));
	
	$this->renderPartial('shop.views.chat._create_form', array('model' => $chatForm, 
				'default_recipient'=>$product->store->user->profile->firstname.' '.$product->store->user->profile->lastname,
				'default_subject'=>'Product: '.$product->title,
				));

	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<script type="text/javascript">
// here is the magic
function sendMessage()
{
	//alert($('#chatdialog div.shipping-form-container form').serialize());
    <?php echo CHtml::ajax(array(
            'url'=>array('chat/create'),
            'data'=> "js:$('#chatdialog div.shipping-form-container form').serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
					$('#chatdialog div.shipping-form-container form #chat_error').html(data.error);
                    //$('#chatdialog div.shipping-form-container').html(data.div);
                          // Here is the trick: on submit-> once again this function!
                    //$('#chatdialog div.shipping-form-container form').submit(sendMessage);
                }
                else
                {
					$('#chatdialog div.shipping-form-container form #ChatForm_message').val('');
					$('#chatdialog div.shipping-form-container form #ChatForm_verifyCode').val('');
					$('#chatdialog div.shipping-form-container form div.captcha a').trigger('click');
					$('#chatdialog div.shipping-form-container form #chat_error').html('<div class=\"alert\">Message has been sent.</div>');
					//$('#chatdialog div.shipping-form-container').html(data.div);
					//setTimeout(\"$('#chatdialog').dialog('close') \",3000);
                }
 
            } ",
            ))?>;
    return false; 
 
}
 
</script>
</div>
