<section  class="product-collateral">
	<script type="text/javascript">
		$(function(){
			var tabContainers=$('section.product-collateral > div.commonContent');
			tabContainers.hide().filter(':first').show();
			$('section.product-collateral ul.tab-block a').click(function(){
				tabContainers.hide();
				tabContainers.filter(this.hash).show();
				$('section.product-collateral ul.tab-block a').removeClass('active');
				$(this).addClass('active');
				return false;
				}).filter(':first').click();
			});
	</script>
<?php 
// Print TabList Header
echo '<ul class="tab-block">';
$isFirst=1;
foreach($tabs as $key=>$tab) {
	if ($isFirst==1) {
		echo '<li><a href="#'.$tab['id'].'" title="'.$tab['title'].'" class="active">'.$tab['title'].'</a></li>';
	}else{
		echo '<li><a href="#'.$tab['id'].'" title="'.$tab['title'].'">'.$tab['title'].'</a></li>';
	}
	$isFirst++;
}
echo '</ul>';

// Print TabList Details
foreach($tabs as $key=>$tab) {
	echo '<div id="'.$tab['id'].'" class="pro-detail commonContent">';
	echo '<ol>';
	foreach($tab['listItems'] as $list) {
		echo '<li><a href="'.$list['link'].'">'.$list['desc'].'</a></li>';
	}
	echo '</ol>';
	echo '</div>';
}
?>
</section>