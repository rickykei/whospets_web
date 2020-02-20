<div style="height: auto;  overflow: hidden;">
<?php
	$positions=$order->positions;
	if($positions){
		foreach ($positions as $position){
			if($position->product_id=='0'){
			}else{
				$product=$position->product;
				echo '<div style="width:180px;float:right;vertical-align:top;padding:5px">';
				echo $product->title;
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
			}
		}
	}
?>
</div>