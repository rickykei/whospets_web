<main class="col-md-9 col-sm-8">
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'order-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		array(            // display 'author.username' using an expression
			//'name'=>'order_id',
			'type'=>'raw',
			'value'=>array($this, '_order_grid'),
		),
		/*
		'order_id',
		'customer.address.firstname',
		'customer.address.lastname',
		array('name' => 'ordering_date',
			'value' => 'date(Shop::module()->dateFormat, $data->ordering_date)',
			'filter' => false
			),
		array('name' => 'status',
			'value' => 'Shop::t($data->status)',
			'filter' => Order::statusOptions(),
			),
		array(
			'class'=>'CButtonColumn', 
			'template' => '{view}',
			'viewButtonUrl'=>'Yii::app()->createUrl("/shop/order/view", array("id"=>$data->order_id))',
		),
		*/
	),
)); ?>
</main><!--/ [col]-->