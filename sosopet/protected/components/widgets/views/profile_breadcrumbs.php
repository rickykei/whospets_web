<div class="breadcrum-container">
	<ul>
		<?php
			foreach($items as $key => $value) {
				if ($value==''){
					echo '<li>'.$key.'</li>';
				}else{
					echo '<li><a href="'.$value.'" title="'.$key.'">'.$key.'</a></li>';
				}	
			}
		?>
	</ul>
</div>