<div class="col-left">
	<div class="block man-block">
		<?php
			echo '<div class="block-title">'.$title.'</div>';
		?>
		<ul>
		<?php
			foreach($items as $item) {
				echo '<li><a href="'.$item['url'].'" title="'.$item['name'].'">'.$item['name'].'</a></li>';
				$keys = array_keys($item);
				if(in_array('items', $keys)){
					foreach($item['items'] as $i) {
						echo '<a style="padding-left:0.5cm;" href="'.$i['url'].'" title="'.$i['name'].'">'.$i['name'].'</a><br>';
					}
				}
			}
		?>		 
		</ul>
	</div>
</div>
