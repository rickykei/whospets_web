<?php
/* @var $this StoreController */
/* @var $data Store */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('store_banner')); ?>:</b>
	<?php echo CHtml::encode($data->store_banner); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('store_logo')); ?>:</b>
	<?php echo CHtml::encode($data->store_logo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('store_name')); ?>:</b>
	<?php echo CHtml::encode($data->store_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('store_description')); ?>:</b>
	<?php echo CHtml::encode($data->store_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('store_email')); ?>:</b>
	<?php echo CHtml::encode($data->store_email); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('store_phone')); ?>:</b>
	<?php echo CHtml::encode($data->store_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipping_fee_us')); ?>:</b>
	<?php echo CHtml::encode($data->shipping_fee_us); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipping_fee_ca')); ?>:</b>
	<?php echo CHtml::encode($data->shipping_fee_ca); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipping_fee_intl')); ?>:</b>
	<?php echo CHtml::encode($data->shipping_fee_intl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('additional_shipping_fee')); ?>:</b>
	<?php echo CHtml::encode($data->additional_shipping_fee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipping_info')); ?>:</b>
	<?php echo CHtml::encode($data->shipping_info); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('policy')); ?>:</b>
	<?php echo CHtml::encode($data->policy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('share_on_fb')); ?>:</b>
	<?php echo CHtml::encode($data->share_on_fb); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hook_paypal')); ?>:</b>
	<?php echo CHtml::encode($data->hook_paypal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hook_facebook')); ?>:</b>
	<?php echo CHtml::encode($data->hook_facebook); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hook_google')); ?>:</b>
	<?php echo CHtml::encode($data->hook_google); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hook_twitter')); ?>:</b>
	<?php echo CHtml::encode($data->hook_twitter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hook_instagram')); ?>:</b>
	<?php echo CHtml::encode($data->hook_instagram); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hook_pinterest')); ?>:</b>
	<?php echo CHtml::encode($data->hook_pinterest); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ship_us')); ?>:</b>
	<?php echo CHtml::encode($data->ship_us); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ship_ca')); ?>:</b>
	<?php echo CHtml::encode($data->ship_ca); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ship_other')); ?>:</b>
	<?php echo CHtml::encode($data->ship_other); ?>
	<br />

	*/ ?>

</div>