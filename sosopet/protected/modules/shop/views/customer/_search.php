<?php
print_r($model);
//print_r($model->address);
exit;
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


	<div class="row">
		<?php echo $form->label($model,'customer_id'); ?>
		<?php echo $form->textField($model,'customer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address_id'); ?>
		<?php echo $form->textField($model,'address_id',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model->address,'zipcode'); ?>
		<?php echo $form->textField($model->address,'zipcode',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model->address,'city'); ?>
		<?php echo $form->textField($model->address,'city',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model->address,'country'); ?>
		<?php echo $form->textField($model->address,'country',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Shop::t('Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
