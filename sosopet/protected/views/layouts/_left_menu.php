<?php
	$this->widget('application.components.widgets.LeftMenuWidget',array(
					'title'=>'Information',
					'items'=>array(
									array('description'=>'Join us', 'href'=>Yii::app()->createUrl('/site/contact'),),
									array('description'=>'How It Works', 'href'=>Yii::app()->createUrl('/site/howitworks'),),
									array('description'=>'FAQ', 'href'=>Yii::app()->createUrl('/site/faq'),),
									array('description'=>'Testimonial', 'href'=>Yii::app()->createUrl('/site/testimonial'),),
								)
				)
			);
?>
