<div id="questiondialog" class="shipping-form-container">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'chat-question-form',
	'action'=>Yii::app()->createUrl('//shop/chat/create'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<div id="chat_error"></div>
	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->hiddenField($model,'recipient'); ?>
	<?php echo $form->hiddenField($model,'product_id'); ?>
	<?php echo $form->hiddenField($model,'pet_id'); ?>
	<?php echo $form->hiddenField($model,'product_name'); ?>
	<ul class="form-fields">
	<li>
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>255,'value'=>$defaultSubject)); ?>
	</li>
	<li>
		<label for="ChatForm_message" class="required">Question <span class="required">*</span></label>
		<?php echo $form->textArea($model,'message',array('maxlength' => 255, 'rows' => 6, 'cols' => 50)); ?>
	</li>
	
	<li>
	
	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="captcha">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha', array('captchaAction' => '/shop/chat/captcha')); ?><br>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>
	</li>
</ul>
<div style="float: right;"><button class="button_blue small_btn" type="button" onclick="sendQuestion();" >Send</button></div>
<?php $this->endWidget(); ?>
</div><!-- form -->
<script type="text/javascript">
// here is the magic
function sendQuestion()
{
	//alert($('#chatdialog form').serialize());
    <?php echo CHtml::ajax(array(
		'url'=>array('chat/create'),
		'data'=> "js:$('#questiondialog form').serialize()",
		'type'=>'post',
		'dataType'=>'json',
		'success'=>"function(data)
		{
			if (data.status == 'success')
			{
				$('#questiondialog form #ChatForm_message').val('');
				$('#questiondialog form #ChatForm_verifyCode').val('');
				$('#questiondialog form div.captcha a').trigger('click');
				$('#questiondialog form #chat_error').html('<div class=\"alert\">Message has been sent.</div>');
				
			}
			else if (data.status == 'failure')
			{
				$('#questiondialog form #chat_error').html(data.error);
			}else{
				location.href='".Yii::app()->createUrl('/user/auth')."';
			}
		} ",
		'error'=> "function(err){   
              location.href='".Yii::app()->createUrl('/user/auth')."'; 
			}", 
		))?>
    return false; 
 
}

</script>
