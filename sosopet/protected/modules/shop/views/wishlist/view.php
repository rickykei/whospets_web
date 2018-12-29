<?php
/* @var $this WishlistController */
/* @var $model Wishlist */

$this->breadcrumbs=array(
	'Wishlists'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Wishlist', 'url'=>array('index')),
	array('label'=>'Create Wishlist', 'url'=>array('create')),
	array('label'=>'Update Wishlist', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Wishlist', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Wishlist', 'url'=>array('admin')),
);
?>

<h1>View Wishlist #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'product_id',
	),
)); ?>
