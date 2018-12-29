<?php
$this->breadcrumbs=array(
	Shop::t('Shipping Methods')=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Shop::t('Update'),
);

?>

<h2><?php echo $model->title; ?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
