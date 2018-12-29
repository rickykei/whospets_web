<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div style="float:left;margin-left:20px;">
		<?php //echo $form->label($model,'category'); ?>
		<?php echo $form->hiddenField($model,'category'); ?>
		<?php echo $form->hiddenField($model,'store_id'); ?>
	</div>
	<?php
		if(!isset($model->minPrice))
			$model->minPrice=0;
		if(!isset($model->maxPrice))
			$model->maxPrice=5000;
		echo '<div style="float:left;margin-left:20px;">Price $';
		echo $form->textField($model,'minPrice',array('size'=>5));
		echo ' </div>';
		$this->widget('zii.widgets.jui.CJuiSliderInput', array(
			'name'=>'slider_range',
			'event'=>'change',
			'options'=>array(
				'values'=>array($model->minPrice,$model->maxPrice),// default selection
				'min'=>0, //minimum value for slider input
				'max'=>5000, // maximum value for slider input
				'animate'=>true,
				// on slider change event 
				//'slide'=>'js:function(event,ui){$("#amount-range").val(ui.values[0]+\'-\'+ui.values[1]);}',
				'slide'=>'js:function(event,ui){$("#SearchProductsForm_minPrice").val(ui.values[0]);$("#SearchProductsForm_maxPrice").val(ui.values[1]);}',
			),
			// slider css options
			'htmlOptions'=>array(
				'style'=>'width:200px;float:left;margin-left:20px;',
			),
		));
		echo '<div style="float:left;margin-left:20px;"> $';
		echo $form->textField($model,'maxPrice',array('size'=>5));
		echo ' </div>';
	?>
	<div style="float:left;margin-left:20px;">
		<?php
			echo $form->labelEx($model, 'condition');
			//echo $form->textField($model, 'condition');
			echo $form->dropDownList($model, 'condition', array_merge(array(''=>'Any'),Shop::module()->conditionOpt));
		?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->