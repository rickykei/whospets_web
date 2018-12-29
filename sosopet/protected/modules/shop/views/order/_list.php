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
	),
)); ?>
</main><!--/ [col]-->