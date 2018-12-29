<?php
/* @var $this StoreController */
/* @var $model Store */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'store_banner'); ?>
		<?php echo $form->textField($model,'store_banner',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'store_logo'); ?>
		<?php echo $form->textField($model,'store_logo',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'store_name'); ?>
		<?php echo $form->textField($model,'store_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'store_description'); ?>
		<?php echo $form->textArea($model,'store_description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'store_email'); ?>
		<?php echo $form->textField($model,'store_email',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'store_phone'); ?>
		<?php echo $form->textField($model,'store_phone',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shipping_fee_us'); ?>
		<?php echo $form->textField($model,'shipping_fee_us'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shipping_fee_ca'); ?>
		<?php echo $form->textField($model,'shipping_fee_ca'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shipping_fee_intl'); ?>
		<?php echo $form->textField($model,'shipping_fee_intl'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'additional_shipping_fee'); ?>
		<?php echo $form->textField($model,'additional_shipping_fee'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shipping_info'); ?>
		<?php echo $form->textArea($model,'shipping_info',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'policy'); ?>
		<?php echo $form->textArea($model,'policy',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'share_on_fb'); ?>
		<?php echo $form->textField($model,'share_on_fb',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hook_paypal'); ?>
		<?php echo $form->textField($model,'hook_paypal',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hook_facebook'); ?>
		<?php echo $form->textField($model,'hook_facebook',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hook_google'); ?>
		<?php echo $form->textField($model,'hook_google',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hook_twitter'); ?>
		<?php echo $form->textField($model,'hook_twitter',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hook_instagram'); ?>
		<?php echo $form->textField($model,'hook_instagram',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hook_pinterest'); ?>
		<?php echo $form->textField($model,'hook_pinterest',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ship_us'); ?>
		<?php echo $form->textField($model,'ship_us',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ship_ca'); ?>
		<?php echo $form->textField($model,'ship_ca',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ship_other'); ?>
		<?php echo $form->textField($model,'ship_other',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->