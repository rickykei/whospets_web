<p class="product-image-zoom">
	<img src="<?php echo $defaultImage; ?>"  alt="Image" title="Image" />
</p>
<p>
	Click on above image to view full picture
</p>
<div class="img-slider">
	<a href="#" title="Prev" class="prev slider-btn"><img src="<?php echo Yii::app()->baseUrl.'/'; ?>images/prev_img_btn.png" title="Prev" alt="Prev" /></a>
	<a href="#" title="Next" class="next slider-btn"><img src="<?php echo Yii::app()->baseUrl.'/'; ?>images/next_img_btn.png" title="Next" alt="Next" /></a>
	<ul id="moreView">
		<?php
			foreach($thumbImages as $image) {
				echo '<li><a class="test-popup-link ajax" href="'.$image.'"><img src="'.$image.'" alt="" title="" width="75px" /></a></li>';
			}
		?>								
	</ul>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/'; ?>js/jquery.jcarousel.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
		$('#moreView').jcarousel({
			scroll: 1,
			easing: 'swing',
			animation: 750,
			visible: 0,
			auto: 0
		});
});
</script>