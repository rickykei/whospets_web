<?php 
	$form=$this->beginWidget('CActiveForm', array(
								'action'=>Yii::app()->request->baseUrl.'/shop/store/update', 
								'id' => $model->id, 
								'method'=>'POST', 
								'htmlOptions'=>array(
									'enctype' => 'multipart/form-data')
								)
							);
?>
<script language="JavaScript" type="text/javascript">
<!--
function submit()
{
	$('#<?php echo $form->id ?>').submit();
}
-->
</script>
<main class="col-md-9 col-sm-8">
</main><!--/ [col]-->
<div class="col-main">
	 <div class="shipping-form-container">
		<?php 
			if (Yum::module())
				Yum::renderFlash();
			echo $form->errorSummary(array($model)); 		
		?>
		
		<?php 
		//	echo $form->labelEx($model,'store_banner'); 
		//	echo $model->getStoreBanner();
		?>
		<?php //echo CHtml::activeFileField($model, 'store_banner'); ?>
		<?php 
			//echo $form->labelEx($model,'store_logo'); 
			//echo $model->getStoreLogo();
		?>
		<?php //echo CHtml::activeFileField($model, 'store_logo'); ?>

		<div class="form-title" ><?php echo Yii::t('shop','My Pet\'s Home');?></div>
		<ul class="form-fields">
		<?php  $form->hiddenField($model,'user_id',array('value'=>Yii::app()->user->id)); ?>
		<li>
			<?php // echo $form->labelEx($model,'store_name'); ?>
			<?php // echo $form->textField($model,'store_name',array('size'=>60,'maxlength'=>100)); ?>
		</li>
		<li>
			<?php echo $form->labelEx($model,'store_description'); ?>
			<?php echo $form->textArea($model,'store_description',array('rows'=>2, 'cols'=>90)); ?>
		</li>
		<li>
			<?php echo $form->labelEx($model,'store_email'); ?>
			<?php echo $form->textField($model,'store_email',array('size'=>60,'maxlength'=>100)); ?>
		</li>
		<li>
			<?php echo $form->labelEx($model,'store_phone'); ?>
			<?php echo $form->textField($model,'store_phone',array('size'=>50,'maxlength'=>50)); ?>
		</li>
		</ul>
		
		
	<br>	
		<a class="colors-btn button_blue middle_btn" href="javascript:submit();" title="Save"><span><?php echo Yii::t('shop','Save');?></span></a>
	</div>
	<div class="clearfix"></div>
	<br>
</div>
<?php $this->endWidget(); ?>



