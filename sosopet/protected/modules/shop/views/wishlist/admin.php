<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->
<div class="secondary_page_wrapper">
	<div class="container">
		<?php 
			$this->widget('application.components.widgets.BreadcrumbsWidget',array(
								'items'=>array(
												array('description'=>'Home', 'href'=>Yii::app()->createUrl('/site/index'),),
												array('description'=>'My Wishlist'),
											)
							)
						);
			$this->renderPartial('profile.views.profile._left_menu');
		?>	
		<main class="col-md-9 col-sm-8">
		<?php 
			$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'wishlist-grid',
			//'dataProvider'=>$products->search(),
			'dataProvider'=>$model->search(),
			'columns'=>array(
				array(            // display 'author.username' using an expression
					'name'=>'id',
					'type'=>'raw',
					'value'=>array($this, '_admin_grid'),
				),
				array(
					'class'=>'CButtonColumn',
					'template' => '{view} {delete}',
					'viewButtonUrl' => 'Yii::app()->createUrl("/shop/products/view",array("id" => $data->product_id))',
				),
			),
		)); ?>
		</main><!--/ [col]-->
	</div><!--/ .container-->
</div><!--/ .page_wrapper-->			
<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->