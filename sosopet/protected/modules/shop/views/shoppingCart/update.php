<?php
$this->breadcrumbs=array(
	'Shopping Carts'=>array('index'),
	$model->cart_id=>array('view','id'=>$model->cart_id),
	Shop::t('Update'),
);

$this->menu=array(
	array('label'=>Shop::t('List') . 'ShoppingCart', 'url'=>array('index')),
	array('label'=>Shop::t('Create') . 'ShoppingCart', 'url'=>array('create')),
	array('label'=>Shop::t('View') . 'ShoppingCart', 'url'=>array('view', 'id'=>$model->cart_id)),
	array('label'=>Shop::t('Manage') . 'ShoppingCart', 'url'=>array('admin')),
);
?>

<h1>Bearbeite ShoppingCart <?php echo $model->cart_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
