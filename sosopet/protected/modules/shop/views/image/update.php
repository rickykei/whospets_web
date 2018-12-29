<?php
$this->breadcrumbs=array(
	'Images'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Shop::t('Update'),
);

$this->menu=array(
	array('label'=>Shop::t('List') . 'Image', 'url'=>array('index')),
	array('label'=>Shop::t('Create') . 'Image', 'url'=>array('create')),
	array('label'=>Shop::t('View') . 'Image', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Shop::t('Manage') . 'Image', 'url'=>array('admin')),
);
?>

<h2>Bearbeite Image <?php echo $model->id; ?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
