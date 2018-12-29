<main class="col-md-9 col-sm-8">
<h2> <?php echo yii::t('shop','Pets'); ?> </h2>
<?php 

//$model = new Products();
$controller = $this;

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'products-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(

        
		array(            // display 'author.username' using an expression
			'name'=>Yii::t('shop','Pets'),
			'type'=>'raw',
			'value'=>array($this, '_admin_grid'),
			/*********
			'value'=>function($data)
                {
                    //return CHtml::link(MHtml::i18nGetValue($data, 'title'), ["page/update", "id" => $data->id]);
					return $data->title.' '.$data->price;
                },
				*********/
        ),
		array(
			'class'=>'CButtonColumn', 
			//'template' => '{view}{update}{delete}{images}',
			'template' => '{view}{update}{delete}',
			//'viewButtonUrl' => 'Yii::app()->createUrl("/shop/products/view",
			//array("id" => $data->product_id))',
			//'updateButtonUrl' => 'Yii::app()->createUrl("/shop/products/update",
			//array("id" => $data->product_id))',
			//'deleteButtonUrl' => 'Yii::app()->createUrl("/shop/products/delete",
			//array("id" => $data->product_id))',
			//'buttons' => array(
			//	'images' => array(
			//		'label' => Shop::t('images'),
			//		'url' => 'Yii::app()->createUrl("/shop/image/create",
			//		array("product_id" => $data->product_id))',
			//	),
			//),
			'htmlOptions'=>array('width'=>'13%'),
		),
	)
)
); 


//echo CHtml::link(Shop::t('Create a new Product'), array('products/create'));
?>
</main><!--/ [col]-->
