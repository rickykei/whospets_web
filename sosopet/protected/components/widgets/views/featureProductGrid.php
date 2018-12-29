<?php 
// Print Feature Product Grid
echo '<ul id="'.$id.'" class="product-grid">';
foreach($products as $key=>$product) {
	echo '<li>';
	echo '<div class="pro-img"><img title="Feature Product" alt="Freature Product" src="'.$product['imgLink'].'" /></div>';
	echo '<div class="pro-hover-block">';
	echo '<h4 class="pro-name">'.$product['name'].'</h4>';
	echo '<div class="link-block"> ';
	echo '<a href="'.$product['quickViewLink'].'" class="quickllook inline" title="Quick View">Quick View</a>';
	echo '<a href="'.$product['detailViewLink'].'" class="quickproLink" title="Link">Product link</a></div>';
	echo '<div class="pro-price">$'.$product['price'].'</div>';
	echo '</div></li>';
}
echo '</ul>';
?>