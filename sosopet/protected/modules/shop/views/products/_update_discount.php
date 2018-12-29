<main class="col-md-9 col-sm-8">
	<div class="shipping-form-container">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'product-form',
		)); ?>
		<?php 
			Shop::renderFlash();
			echo $form->errorSummary(array($model)); 
		?>
		<h3>Update Discount</h3>
		<ul class="form-fields">
		<li>
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php $this->widget('application.modules.shop.components.Relation', array(
			'model' => $model,
			'relation' => 'category',
			'fields' => array('title','parent_id','category_id'),
			'template' => '{fields}',
			'showAddButton' => false,
		)); ?>
		</li>
		<li>
		<?php
			echo $form->labelEx($model, 'discount');
			echo $form->textField($model, 'discount');
		?>
		</li>
		<li>
		<input class="button_blue middle_btn" type="submit" value="Save" />
		</li>
		</ul>
		<?php $this->endWidget(); ?>
	</div>
</main><!--/ [col]-->



