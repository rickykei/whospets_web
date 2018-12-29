<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->
<ul class="breadcrumbs">
<?php
	$href='#';
	
	foreach($items as $item) {
		if (isset($item['href']))
			echo '<li><a href="'.$item['href'].'">'.(isset($item['description'])?$item['description']:'').'</a></li>'."\xD\xA";
		else
			echo '<li>'.(isset($item['description'])?$item['description']:'').'</li>'."\xD\xA";
	}
?>
</ul>
<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->
