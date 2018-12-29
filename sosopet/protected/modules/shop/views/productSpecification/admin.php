<?php
$this->breadcrumbs=array(
	 Shop::t('Product Specifications')=>array('admin'),
	 Shop::t('Manage'),
);

?>

<h2><?php echo Shop::t('Manage Product Specifications'); ?></h2>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-specification-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'title',
		'input_type',
		array(
			'name' => 'required',
			'value' => '$data->required ? Shop::t("Yes") : Shop::t("No")'),
		array(
			'class'=>'CButtonColumn',
		),
	),
));

echo CHtml::link(Shop::t('New Specification'), array('productSpecification/create'));
