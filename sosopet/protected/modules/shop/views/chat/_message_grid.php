<?php
	$folder = Shop::module()->chatThumbImagesFolder;
	$images=$message->images;
	echo '<div style="float:none;width:auto;overflow:hidden;position:relative;">';
	if($images){
		foreach ($images as $image)
			echo '<img height="90" src="'.Yii::app()->baseUrl.'/'.$folder.'/'.$image->filename.'" />';
	}else{
		echo CHtml::image(Shop::register('no-pic.jpg'));
	}
	
?>
