<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'image-form',
	'htmlOptions'=>array('enctype' => 'multipart/form-data'),
	'enableAjaxValidation'=>false,
)); ?>
<script language="JavaScript" type="text/javascript">
<!--
function submit()
{
	$('#<?php echo $form->id ?>').submit();
}
-->
</script>
<div class="shipping-form-container">
	<?php 
		Yum::renderFlash();
		echo $form->errorSummary(array($model)); 
	?>
	<ul class="form-fields">
	<li>
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>45,'maxlength'=>45)); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'filename'); ?>
		<?php echo $form->fileField($model,'filename',array('size'=>45,'maxlength'=>45)); ?>
	</li>

		<?php echo $form->hiddenField($model,'product_id', array('value' => $_GET['product_id'])); ?>

	<a class="colors-btn" href="javascript:submit();" title="Upload"><span><span>Upload</span></span></a>

</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
