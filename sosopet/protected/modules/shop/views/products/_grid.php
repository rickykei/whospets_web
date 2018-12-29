<div style="height:auto;">
<div style="height: auto;  overflow: hidden;">
<?php

	$folder = Shop::module()->productThumbImagesFolder;
	$images=$product->images;
	echo '<div style="float:left;width:auto;overflow:hidden;position:relative;">';
	if($images){
		$image=$product->getDefaultImage();
		if(!$image)
			$image=current($images);
		echo '<img height="90" src="'.Yii::app()->baseUrl.'/'.$folder.'/'.$image->filename.'" />';
	}else{
		echo CHtml::image(Shop::register('no-pic.jpg'));
	}
	echo '</div>';

echo '<div style="float:left;vertical-align:top;padding:5px;position:relative">';
        echo $product->title;
        echo '<br>';
        echo '<br>';
        echo '<div style="padding:3px;border:grey 1px solid;display:inline">'.$product->view.'</div>'.' views';
        echo '</div>';

	
?>
</div>
