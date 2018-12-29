<?php
$this->breadcrumbs=array();

?>

<h1> <?php echo Shop::t('Your Shopping Cart contains: '); ?> </h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'shopping cart-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'Product.title',
		'amount',
		'Product.unit',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
