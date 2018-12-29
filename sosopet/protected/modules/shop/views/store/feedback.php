<section class="content-wrapper">
	<div class="content-container container">
		<div class="col-left">
			<div class="block man-block">
			<?php 
				echo $model->getStoreBanner();
			?>
			<p> Seller Name: <?php echo $model->user->profile->lastname.' , '.$model->user->profile->firstname;?></p>
			<p> Feedback: <a href="<?php echo Yii::app()->createUrl('/shop/store/feedback',array('id' => $model->id)); ?>"><?php echo $model->getFeedback();?>%</a></p>
			<p> Store: <a href="<?php echo Yii::app()->createUrl('/shop/store/view',array('id' => $model->id)); ?>">View Store</a></p>
			<?php
				$this->widget('zii.widgets.jui.CJuiAccordion',array(
					'panels'=>array(
						'About Store'=>$model->store_description,
						'Shipping Policy'=>$model->shipping_info,
						'Payment / Refund Policy'=>$model->policy,
						// panel 3 contains the content rendered by a partial view
						//'panel 3'=>$this->renderPartial('_renderpage',null,true),
					),
					// additional javascript options for the accordion plugin
					'options'=>array(
						'collapsible'=> true,
						'animated'=>'bounceslide',
						'autoHeight'=>false,
						'active'=>2,
						'icons'=>array(
							"header"=>"ui-icon-plus",//ui-icon-circle-arrow-e
							 "headerSelected"=>"ui-icon-circle-arrow-s",//ui-icon-circle-arrow-s, ui-icon-minus
						),
					),
				));
			?>
			</div>
		</div>
		<div class="col-main">

			<?php 
				//$dataProvider =  new CArrayDataProvider('Feedbacks');
				//$dataProvider->setData($model->feedbacks);
				$dataProvider=$model->searchFeedbacks();
				$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'feedback-grid',
				'dataProvider'=>$dataProvider,
				'columns'=>array(
					array(
						'name'=>'Feedbacks',
						'type'=>'raw',
						'value'=>array($this, '_feedback_grid'),
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
						'value'=>array($this, '_product_grid'),
					),
				),
			)); ?>
		
		
		
		</div>
	</div>
</section>
<div class="clear"> </div>