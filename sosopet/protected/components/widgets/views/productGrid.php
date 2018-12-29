<?php 
// Print Product Grid
// Size = 4
//$size = 4;
$i = 0;
foreach($products as $key=>$product) {
	$i++;
	if ($i % $size == 1) {
		echo '<ul class="product-grid">';
	}
	echo '<li><div class="pro-img">';
	echo '<a href="'.$product['detailViewLink'].'"><img title="New Product" alt="New Product" src="'.$product['imgLink'].'" /></a>';
	echo '</div>';
	echo '<div class="pro-content"><p>'.$product['name'].'</p></div>';
	echo '<div class="pro-price">$'.$product['price'].'</div>';
	echo '<div class="pro-btn-block">';
	echo '<a class="add-cart left" href="'.$product['cartLink'].'" title="Add to Cart">Add to Cart</a>';
	echo '<a class="add-cart right quickCart inline" href="'.$product['quickViewLink'].'" title="Quick View">Quick View</a></div>';
	echo '<div class="pro-link-block"> <a class="add-wishlist left" href="'.$product['wishlistLink'].'" title="Add to wishlist">Add to wishlist</a>';
	echo '<div class="clearfix"></div>';
	echo '</div></li>';
	
	if ($i % $size == 0) {
		echo '</ul>';
	}
}

if ($i % $size <> 0) {
	echo '</ul>';
}
?>