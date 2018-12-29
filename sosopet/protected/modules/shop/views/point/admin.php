<?php
$this->breadcrumbs=array(
	Shop::t('Points')=>array('index'),
	Shop::t('Manage'),
);
?>

<h2><?php echo Shop::t('Manage Points'); ?></h2>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'point-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'description',
		'value',
		'threshold',
		array(
			'class'=>'CButtonColumn',
		),
	),
));

echo CHtml::link(Shop::t('Create Point'), array('point/create'));
