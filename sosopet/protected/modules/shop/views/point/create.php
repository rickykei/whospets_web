<?php
$this->breadcrumbs=array(
	Shop::t('Points')=>array('index'),
	Shop::t('Create'),
);
?>

<h2><?php echo Shop::t('Create Point'); ?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>