<div class="col-main">
	<div class="shipping-form-container">
	
	<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'feedback-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
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
	<?php 
		Shop::renderFlash();
		echo $form->errorSummary($model); 
	?>
	<ul class="form-fields">
		<li>
		<?php
			if(!$model->isNewRecord){
				echo $form->labelEx($model, 'create_date');
				echo $model->create_date;
			}
		?>
		</li>
		<li>
			<?php echo $form->labelEx($model,'feedback',array('style'=>'float:left;')); ?>
			<div class="compactRadioGroup">
			<?php //echo $form->radioButtonList($model,'feedback',array('1'=>'Positive','-1'=>'Neutral', '0'=>'Negative'),array('style'=>'-webkit-transform: scale(0.5, 0.5);display:inline;float:left;')); ?>
			<?php echo $form->dropDownList($model,'feedback',array('1'=>'Positive','-1'=>'Neutral', '0'=>'Negative')); ?>
			</div>
		</li>
		<li>
			<?php echo $form->labelEx($model,'comment'); ?>
			<?php echo $form->textArea($model, 'comment', array('maxlength' => 300));
			?>
		</li>
	</ul>
	<a class="colors-btn" href="javascript:submit();" title="Save"><span><span>Save</span></span></a>
	<div class="clearfix"></div>
	
	
	<br>
	<br>
<?php $this->endWidget(); ?>

</div><!-- form -->
	
	</div>
</div>
