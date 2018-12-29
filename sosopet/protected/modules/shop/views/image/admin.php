<?php
if($images)
	foreach($images as $image) {
		echo "<label> {$image->title} </label><br />";
		$this->renderPartial('shop.views.image.view', array('model' => $image));
		echo "<br />";
	}


echo '<br />';
?>
