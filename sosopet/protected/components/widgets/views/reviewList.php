<div class="review-list">
<?php
	
	foreach($items as $item) {
		echo '<div class="author">';
		echo '<span class="name">'.(isset($item['author'])?$item['author']:'').'</span>';
		echo (isset($item['date'])?', '.date("Y-m-d",strtotime($item['date'])):'').'</div>';
		echo '<div class="text">'.(isset($item['comment'])?$item['comment']:'').'</div>';
	}
?>
</div>
