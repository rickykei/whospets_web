<!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->
<section class="section_offset">
	<h3><?php echo $title ?></h3>
	<ul class="theme_menu">
		<?php
			$href='#';
			
			foreach($items as $item) {
					echo '<li><a href="'.(isset($item['href'])?$item['href']:'').'">'.(isset($item['description'])?$item['description']:'').'</a></li>'."\xD\xA";
			}
		?>
	</ul>
</section><!--/ .section_offset -->
<!-- - - - - - - - - - - - - - End of information - - - - - - - - - - - - - - - - -->
