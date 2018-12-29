<?php
$this->breadcrumbs=array(
	Shop::t('Customers')=>array('index'),
	Shop::t('Manage'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('customer-grid', {
		url: $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");
?>

	<h1><?php echo Shop::t('Admin Customers'); ?></h1>

<?php echo CHtml::link(Shop::t('Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'customer_id',
		'user_id',
		'address',
		'zipcode',
		'city',
		'country',
		'email',
		'accPoint',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
