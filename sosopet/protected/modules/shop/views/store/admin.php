<?php
/* @var $this StoreController */
/* @var $model Store */

$this->breadcrumbs=array(
	'Stores'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Store', 'url'=>array('index')),
	array('label'=>'Create Store', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#store-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Stores</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'store-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'store_banner',
		'store_logo',
		'store_name',
		'store_description',
		/*
		'store_email',
		'store_phone',
		'shipping_fee_us',
		'shipping_fee_ca',
		'shipping_fee_intl',
		'additional_shipping_fee',
		'shipping_info',
		'policy',
		'share_on_fb',
		'hook_paypal',
		'hook_facebook',
		'hook_google',
		'hook_twitter',
		'hook_instagram',
		'hook_pinterest',
		'ship_us',
		'ship_ca',
		'ship_other',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
