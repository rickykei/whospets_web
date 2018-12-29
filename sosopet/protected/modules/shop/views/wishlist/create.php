<?php
/* @var $this WishlistController */
/* @var $model Wishlist */

$this->breadcrumbs=array(
	'Wishlists'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Wishlist', 'url'=>array('index')),
	array('label'=>'Manage Wishlist', 'url'=>array('admin')),
);
?>

<h1>Create Wishlist</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>