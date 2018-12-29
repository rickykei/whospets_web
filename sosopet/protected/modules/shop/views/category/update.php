<?php
$this->breadcrumbs=array(
	Shop::t('Categories')=>array('index'),
	$model->title=>array('view','id'=>$model->category_id),
	Shop::t('Update'),
);

?>

<h1><?php echo Shop::t('Update Category'); ?> <?php echo $model->category_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
