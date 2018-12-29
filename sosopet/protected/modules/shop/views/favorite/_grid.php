<div>
<?php
	echo $store->getStoreLogo();
?>
</div>
<div>
<?php
	echo $store->store_name;
	echo '<br>';
	echo 'Feedback: '.$store->getFeedback().'%';
?>
</div>