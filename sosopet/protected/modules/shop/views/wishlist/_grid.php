<div style="height:30px;">
<div class="left">
<?php
	echo $product->title;
?>
</div>
</div>
<div style="height: auto;  overflow: hidden;">
<?php
	echo '<div style="width:480px;float:right;vertical-align:top;padding:5px">';
	//echo $product->title.' '.$product->price;
	echo $product->title;
	echo '<br>';
	echo '<br>';
	echo '<div style="padding:3px;border:grey 1px solid;display:inline">'.$product->view.'</div>'.' views';
	echo '</div>';

	$folder = Shop::module()->productThumbImagesFolder;
	$images=$product->images;
	echo '<div style="float:none;width:auto;overflow:hidden;position:relative;">';
	if($images){
		$image=$product->getDefaultImage();
		if(!$image)
			$image=current($images);
		echo '<img src="'.Yii::app()->baseUrl.'/'.$folder.'/'.$image->filename.'" />';
	}else{
		echo CHtml::image(Shop::register('no-pic.jpg'));
	}
	echo '</div>';
	
?>
</div>