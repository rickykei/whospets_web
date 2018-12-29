<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->
<div class="secondary_page_wrapper">
	<div class="container">
		<?php
			$this->widget('application.components.widgets.BreadcrumbsWidget',array(
								'items'=>array(
												array('description'=>'Home', 'href'=>Yii::app()->createUrl('/site/index'),),
												array('description'=>'My Feedbacks'),
											)
							)
						);
			$this->renderPartial('profile.views.profile._left_menu');
		?>
		<main class="col-md-9 col-sm-8">
		<?php
			$controller = $this;
			$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'feedback-grid',
			'dataProvider'=>$model->search(),
			'columns'=>array(
					array(
						'name'=>'Feedbacks',
						'type'=>'raw',
						'value'=>array($this, '_admin_feedback_grid'),
						'htmlOptions'=>array('style' => 'vertical-align:middle;width:250px;'),
					),
					/*
					array(
						'name'=>'feedbacks',
						'type'=>'html',
						'value'=>'(!empty($data->feedback))?CHtml::image(Yii::app()->createUrl("/shop/products/view",array("id" => $data->product_id)),"",array("style"=>"width:25px;height:25px;")):"no image"',
						'htmlOptions'=>array('style' => 'vertical-align:middle;'),
					),
					*/
					array(
						'name'=>'Date',
						'header'=>'Date',
						'value'=>'Yii::app()->dateFormatter->format("d MMM y",strtotime($data->create_date))',
						'htmlOptions'=>array('style' => 'vertical-align:middle;width:100px;'),
					),
					array(
						'name'=>'User',
						'type'=>'html',
						'value'=>'$data->user->username',
						'htmlOptions'=>array('style' => 'vertical-align:middle;width:130px;'),
					),
					array(
						'name'=>'Product',
						'type'=>'raw',
						'value'=>array($this, '_admin_product_grid'),
					),
				),
			));
		?>
		</main><!--/ [col]-->
	</div><!--/ .container-->
</div><!--/ .page_wrapper-->			
<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->