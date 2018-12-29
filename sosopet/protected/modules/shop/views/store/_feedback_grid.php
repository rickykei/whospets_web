<?php
	echo '<div style="width:50px;float:left;">';
	switch ($feedback->feedback) {
		case 0:
			echo "-";
			break;
		case 1:
			echo "+";
			break;
		case -1:
			echo "o";
			break;
	}
	echo '</div>';
	echo '<div style="width:200px;float:left;">';
	echo $feedback->comment;
	echo '</div>';
?>
