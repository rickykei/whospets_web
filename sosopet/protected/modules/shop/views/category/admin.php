<?php 
$this->breadcrumbs=array(
	 Shop::t('Category')=>array('admin'),
	 Shop::t('Manage'),
);

?>

<h2> <?php echo Shop::t('Category'); ?> </h2>

<?php
$model = new Category();

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'title',
		array(
			'class'=>'CButtonColumn', 
			'viewButtonUrl' => 'Yii::app()->createUrl("/shop/category/view",
			array("id" => $data->category_id))',
			'updateButtonUrl' => 'Yii::app()->createUrl("/shop/category/update",
			array("id" => $data->category_id))',
			'deleteButtonUrl' => 'Yii::app()->createUrl("/shop/category/delete",
			array("id" => $data->category_id))',
		),
	),
)); 

echo CHtml::link(Shop::t('Create a new Category'), array('category/create'));

?>
