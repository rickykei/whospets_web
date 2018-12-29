<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->
 
<div class="nav_item size_1">
	<button class="open_menu"></button>
	<!-- - - - - - - - - - - - - -x Main navigation - - - - - - - - - - - - - - - - -->
	<ul class="theme_menu cats dropdown">
	<?php
		$href='#';
		
		foreach($items as $item) {
				//echo '<li><a href="'.(isset($item['href'])?$item['href']:'').'">'.(isset($item['description'])?$item['description']:'').'</a></li>'."\xD\xA";
				echo '<li class="'.(isset($item['items'])?'has_megamenu':'').' animated_item"><a href="'.(isset($item['href'])?$item['href']:'').'">'.(isset($item['description'])?$item['description']:'').'</a>'."\xD\xA";
				if (isset($item['items'])) {
					echo '<!-- - - - - - - - - - - - - - Mega menu - - - - - - - - - - - - - - - - -->'."\xD\xA";
					echo '<div class="mega_menu clearfix">'."\xD\xA";
					echo '<!-- - - - - - - - - - - - - - Mega menu item - - - - - - - - - - - - - - - - -->'."\xD\xA";
					echo '<div class="mega_menu_item">';
					echo '<ul class="list_of_links">';
					foreach($item['items'] as $subitem){
						echo '<li><a href="'.(isset($subitem['href'])?$subitem['href']:'').'">'.(isset($subitem['description'])?$subitem['description']:'').'</a></li>';
					}
					echo '</ul>';
					echo '</div><!--/ .mega_menu_item-->';
					echo '<!-- - - - - - - - - - - - - - End of mega menu item - - - - - - - - - - - - - - - - -->'."\xD\xA";
					echo '</div><!--/ .mega_menu-->'."\xD\xA";
					echo '<!-- - - - - - - - - - - - - - End of mega menu - - - - - - - - - - - - - - - - -->'."\xD\xA";
				}
				echo '</li>';
		}
	?>
	</ul>
	<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->
</div><!--/ .nav_item-->
<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->
