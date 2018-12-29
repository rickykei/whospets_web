<?php
$this->breadcrumbs=array(
	Shop::t('Payment Methods')=>array('index'),
	Shop::t('Create'),
);

?>

<h2> <?php echo Shop::t('Create Payment method'); ?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
