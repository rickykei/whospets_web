<div class="section_offset">
<div class="row">
<?php
	$href='#';
	
	foreach($items as $item) {
		echo '<div class="col-sm-4">';
		echo '<a href="'.(isset($item['href'])?$item['href']:$href).'" class="banner animated transparent" data-animation="fadeInDown" target="'.$item['target'].'">';
		echo '<img src="'.$item['image'].'" alt="">';
		echo '</a></div><!--/ [col]-->'."\xD\xA";
	}
?>
</div><!--/ .row-->
</div><!--/ .section_offset-->
