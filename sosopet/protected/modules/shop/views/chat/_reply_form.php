<div class="shipping-form-container">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'chat-message-form',
	'action'=>Yii::app()->createUrl('//shop/chat/update').'/'.$model->chat_id,
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<div id="chat_error"></div>
	<?php echo $form->errorSummary($model); ?>

	<ul class="form-fields">
	<li>
		<?php echo $form->hiddenField($model,'chat_id'); ?>
	</li>
	<li>
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('maxlength' => 255, 'rows' => 6, 'cols' => 50)); ?>
	</li>
	
	<li>
	
	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="captcha">
		<?php 
		 
		echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha', array('captchaAction' => '/shop/chat/captcha')); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint"><?php echo Yii::t('shop','Please enter the letters as they are shown in the image above.');?>
		<br/><?php echo Yii::t('shop','Letters are not case-sensitive.');?></div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>
	</li>
	<li>
		<input class="button_blue middle_btn" type="submit" value="<?php echo Yii::t('shop','send message');?>" />
	</li>
	<li>
	<?php
		$this->widget('xupload.XUpload', array(
							'url' => Yii::app()->createUrl("shop/chat/upload", array("parent_id" => 1)),
							'model' => $upload,
							'attribute' => 'file',
							'multiple' => true,
							'options' => array(
								'maxNumberOfFiles'=>Shop::module()->imageLimit,
								//'maxFileSize' => 3000000,
								//'acceptFileTypes' => "js:/(\.|\/)(jpe?g|png|gif|bmp)$/i",
							),
							'htmlOptions' => array('id'=>'chat-message-form'),
		));

	?>
	</li>
</ul>

<?php $this->endWidget(); ?>
</div><!-- form -->