<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->
<div class="secondary_page_wrapper">
	<div class="container">
		<?php
			$this->widget('application.components.widgets.BreadcrumbsWidget',array(
								'items'=>array(
												array('description'=>Yii::t('shop','Home'), 'href'=>Yii::app()->createUrl('/site/index'),),
												array('description'=>Yii::t('shop','Feedbacks')),
											)
							)
						);
			$this->renderPartial('shop.views.layouts._left_menu');
		?>
		<main class="col-md-9 col-sm-8">
		<?php
			$controller = $this;
				$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'feedback-grid',
				'dataProvider'=>$model->search(),
				'columns'=>array(
					/*
					array(
						'name'=>'Feedbacks',
						'type'=>'raw',
						'value'=>array($this, '_admin_feedback_grid'),
						'htmlOptions'=>array('style' => 'vertical-align:middle;width:250px;'),
					),
					array(
						'name'=>'feedbacks',
						'type'=>'html',
						'value'=>'(!empty($data->feedback))?CHtml::image(Yii::app()->createUrl("/shop/products/view",array("id" => $data->product_id)),"",array("style"=>"width:25px;height:25px;")):"no image"',
						'htmlOptions'=>array('style' => 'vertical-align:middle;'),
					),
					*/
					array(
						'name'=>'Date',
						'header'=>Yii::t('shop','date'),
						'value'=>'Yii::app()->dateFormatter->format("d MMM y H:m:s",strtotime($data->create_date))',
						'htmlOptions'=>array('style' => 'vertical-align:middle;width:100px;'),
					),
					array(
						'name'=>'User',
						'header'=>Yii::t('shop','user'),
						'type'=>'html',
						'value'=>'$data->user->username',
						'htmlOptions'=>array('style' => 'vertical-align:middle;width:130px;'),
					),
					array(
						'name'=>'Comment',
						'header'=>Yii::t('shop','comment'),
						'type'=>'html',
						'value'=>'$data->comment',
						//'htmlOptions'=>array('style' => 'vertical-align:middle;width:130px;'),
					),
				),
			));
		?>
		</main><!--/ [col]-->
	</div><!--/ .container-->
</div><!--/ .page_wrapper-->			
<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
