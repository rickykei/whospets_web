<?php
/* @var $this ChatController */
/* @var $model Chat */
/* @var $form CActiveForm */
?>

<div class="shipping-form-container">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'chat-form',
	'action'=>Yii::app()->createUrl('//shop/chat/create'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<div id="chat_error"></div>
	<?php //echo $form->errorSummary($model); ?>

	<ul class="form-fields">
	<li>
		<?php //echo $form->labelEx($model,'recipient'); ?>
		<?php //echo $default_recipient; ?>
		<?php echo 'To: '.$default_recipient; ?>
		<?php echo $form->hiddenField($model,'recipient'); ?>
	</li>
	<li>
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>255,'value'=>$default_subject)); ?>
	</li>
	<li>
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('maxlength' => 255, 'rows' => 6, 'cols' => 50)); ?>
	</li>
	
	<li>
	
	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="captcha">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha', array('captchaAction' => '/shop/chat/captcha')); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>
	</li>
</ul>

<?php $this->endWidget(); ?>

</div><!-- form -->
