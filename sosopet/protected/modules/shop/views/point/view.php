<?php
$this->breadcrumbs=array(
	Shop::t('Points')=>array('index'),
	Shop::t($model->title),
);
?>

<h2><?php echo Shop::t('View Point'); ?>#<?php echo $model->id; ?></h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'value',
		'threshold',
	),
)); ?>
