<?php
	$slides= array(
				array('image'=>Yii::app()->request->baseUrl.'/images/home_slide_10.jpg',
					'line1'=>array('description'=>'香港每月'),
					'line2'=>array('description'=>'平均200宗'),
					'line3'=>array('description'=>'寵物報失個案'),
					'button'=>array('description'=>'了解更多!', 'href'=>'/en/site/howitworks'),
				),
				array('image'=>Yii::app()->request->baseUrl.'/images/home_slide_11.jpg',
					'line1'=>array('description'=>'我們能夠有效', 'style'=>'left: 50%;'),
					'line2'=>array('description'=>'幫助尋找', 'style'=>'left: 50%;'),
					'line3'=>array('description'=>'遺失寵物的主人', 'style'=>'left: 50%;'),
					'button'=>array('description'=>'了解更多!', 'style'=>'left: 50%;','href'=>'/en/site/howitworks'),
				),
				array('image'=>Yii::app()->request->baseUrl.'/images/home_slide_12.jpg',
					'line1'=>array('description'=>'使更多遺失的', 'style'=>'left: 40%;'),
					'line2'=>array('description'=>'寵物與主人', 'style'=>'left: 40%;'),
					'line3'=>array('description'=>'團聚', 'style'=>'left: 40%;'),
					'button'=>array('description'=>'了解更多!', 'style'=>'left: 40%;','href'=>'/en/site/howitworks'),
				),
			);
	$this->widget('application.components.widgets.LayerSliderWidget',array(
				'items'=>$slides
			)
		);
?>
