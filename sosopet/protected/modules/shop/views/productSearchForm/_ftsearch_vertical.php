<script language="JavaScript" type="text/javascript">
	<!--
	function searchByCat(cat)
	{
		$("#SearchProductsForm_category").val(cat);
		$('#<?php echo $form->id ?>').submit();
	}
	-->
</script>
<?php if($model->category){ ?>
<div class="block man-block">
	<?php 
		$category=Category::model()->findByPk($model->category); 
		$subcats=Category::model()->findAllByAttributes(array('parent_id'=>$model->category));
	?>
	<div class="block-title">
	<?php 
		//echo $category->title; 
		echo '<a href="javascript:searchByCat(\'\');" title="'.$category->title.'">'.$category->title.'</a>';
	?>
	</div>
	<ul>
		<?php
			foreach($subcats as $subcat){
				echo '<li><a href="javascript:searchByCat('.$subcat->category_id.');" title="'.$subcat->title.'">'.$subcat->title.'</a></li>';
			}
		?>
	</ul>
</div>
<?php }else{?>
<div class="block man-block">
	<?php 
		$subcats=Category::model()->findAll(); 
	?>
	<div class="block-title">Brands</div>
	<ul>
		<?php
			foreach($subcats as $subcat){
				echo '<li><a href="javascript:searchByCat('.$subcat->category_id.');" title="'.$subcat->title.'">'.$subcat->title.'</a></li>';
			}
		?>
	</ul>
</div>
<?php } ?>
<div class="block shop-by-block">
	<div class="block-title">Price</div>
	<!--
	<ul>
		 
		<li><a href="#" title="$300.00 - $399.99 (1)">$300.00 - $399.99 (1)</a></li>
		<li><a href="#" title="$300.00 - $399.99 (1)">$300.00 - $399.99 (1)</a></li>
		<li><a href="#" title="$300.00 - $399.99 (1)">$300.00 - $399.99 (1)</a></li>
		<li><a href="#" title="$300.00 - $399.99 (1)">$300.00 - $399.99 (1)</a></li>
	</ul>
	-->
	<?php
	if(!isset($model->minPrice))
		$model->minPrice=0;
	if(!isset($model->maxPrice))
		$model->maxPrice=5000;
	echo '<div class="row" style="padding-left:5px">Price $';
	echo $form->textField($model,'minPrice',array('size'=>5));
	echo '- $';
	echo $form->textField($model,'maxPrice',array('size'=>5));
	echo '</div>';
	echo '<div class="row" style="padding-left:5px">';
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
			'style'=>'width:150px;float:left;margin-left:20px;',
		),
	));
	echo '</div>';
?>
</div>
<div class="block shop-by-block">
	<div class="block-title">Size</div>
	<?php 
		echo $form->checkBoxList($model,'size',
			SizeGuide::model()->getSizeOptions(),
			array(
				'template'=>'{input}{label}',
				'separator'=>'',
				'labelOptions'=>array(
					'style'=> 'width: 50px;float: left;'),
				'style'=>'float:left;',
			)                              
		);
	?>
</div>
<div class="block shop-by-block">
	<div class="block-title">Condition</div>
	<?php
		echo $form->dropDownList($model, 'condition', array_merge(array(''=>'Any'),Shop::module()->conditionOpt));
	?>
</div>
<div class="paypal-block">
	<div class="buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>
</div>
<div class="paypal-block">
	<?php echo CHtml::image(Yii::app()->getBaseUrl(true).'/images/paypal_img.png'); ?>
</div>
<div class="row">
	<?php //echo $form->label($model,'category'); ?>
	<?php echo $form->hiddenField($model,'category'); ?>
	<?php echo $form->hiddenField($model,'store_id'); ?>
</div>
<!-- search-form -->