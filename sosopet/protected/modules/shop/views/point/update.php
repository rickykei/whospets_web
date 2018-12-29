<?php
$this->breadcrumbs=array(
	Shop::t('Points')=>array('index'),
	Shop::t($model->title)=>array('view','id'=>$model->id),
	Shop::t('Update'),
);
?>

<h2><?php echo Shop::t('Update Point'); ?> <?php echo $model->id; ?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>