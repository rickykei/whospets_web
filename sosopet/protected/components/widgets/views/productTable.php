<div class="table_layout" id="products_container">
	<?php
		$title='';
		$description='';
		$href='#';
		$itemCount=0;
		foreach($items as $item) {
			$itemCount++;
			if ($itemCount % $noOfRowItems == 1) {
				echo '<div class="table_row">'."\xD\xA";
			}
			echo '<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->'."\xD\xA";
			echo '<div class="table_cell"><div class="product_item">'."\xD\xA";
			echo '<!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->'."\xD\xA";
			echo '<div class="image_wrap">';
			echo '<a href="'.(isset($item['href'])?$item['href']:$href).'" >';
			echo '<img src="'.(isset($item['image'])?$item['image']:'').'" alt="">'."\xD\xA";
			
			echo '<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->'."\xD\xA";
			
			echo '<div class="actions_wrap">';
			echo '<div class="centered_buttons">';
			//echo '<a href="'.(isset($item['href'])?$item['href']:$href).'" class="button_dark_grey middle_btn quick_view">Quick View</a>';
			//echo '<a href="'.(isset($item['cartLink'])?$item['cartLink']:$href).'" class="button_blue middle_btn add_to_cart">Add to Cart</a>';
			echo '</div><!--/ .centered_buttons -->';
			//echo '<a href="'.(isset($item['wishlistLink'])?$item['wishlistLink']:$href).'" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a>';
			//echo '<a href="#" class="button_dark_grey def_icon_btn middle_btn add_to_compare tooltip_container"><span class="tooltip left">Add to Compare</span></a>';
			echo '</div><!--/ .actions_wrap-->	';
			echo '<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->'."\xD\xA";
			echo '</div><!--/. image_wrap-->';
			echo '<!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->'."\xD\xA";
			echo '</a>';
			echo '<!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->'."\xD\xA";
			echo '<div class="description">';
			echo '<a href="'.(isset($item['href'])?$item['href']:$href).'">'.(isset($item['title'])?$item['title']:$title).'</a>';
			echo '<div class="clearfix product_info">';
			if (isset($item['discountPrice']))
				;//echo '<p class="product_price alignleft"><s>'.(isset($item['price'])?'$'.$item['price']:'').'</s> <b>'.(isset($item['discountPrice'])?'$'.$item['discountPrice']:'').'</b></p>';
			else
				;//echo '<p class="product_price alignleft"><b>'.(isset($item['price'])?'$'.$item['price']:'').'</b></p>';
			//echo '<!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->';
			//echo '<ul class="rating alignright">';
			//echo '<li class="active"></li>';
			//echo '<li class="active"></li>';
			//echo '<li class="active"></li>';
			//echo '<li class="active"></li>';
			//echo '<li></li>';
			//echo '</ul>';
			//echo '<!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->';
			echo '</div>';
			echo '</div>';
			echo '<!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->'."\xD\xA";
			
			echo '<!-- - - - - - - - - - - - - - Full description (only for list view) - - - - - - - - - - - - - - - - -->'."\xD\xA";
			echo '<div class="full_description">';
			echo '<a href="'.(isset($item['href'])?$item['href']:$href).'" class="product_title">'.(isset($item['title'])?$item['title']:$title).'</a>';
			//echo '<a href="#" class="product_category">Beauty Clearance</a>';
			echo '<div class="v_centered product_reviews">';
			//echo '<!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->';
			//echo '<ul class="rating">';
			//echo '<li class="active"></li>';
			//echo '<li class="active"></li>';
			//echo '<li class="active"></li>';
			//echo '<li class="active"></li>';
			//echo '<li></li>';
			//echo '</ul>';
			//echo '<!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->';
			//echo '<!-- - - - - - - - - - - - - - Reviews menu - - - - - - - - - - - - - - - - -->';
			//echo '<ul class="topbar">';
			//echo '<li><a href="#">3 Review(s)</a></li>';
			//echo '<li><a href="#">Add Your Review</a></li>';
			//echo '</ul>';
			//echo '<!-- - - - - - - - - - - - - - End of reviews menu - - - - - - - - - - - - - - - - -->';
			echo '</div>';
			echo (isset($item['description'])?$item['description']:$description);
			//echo '<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euismod in, auctor ut, ligula.</p>';
			echo '<a href="#" class="learn_more">Learn More</a>';
			echo '</div>';
			echo '<!-- - - - - - - - - - - - - - End of full description (only for list view) - - - - - - - - - - - - - - - - -->'."\xD\xA";
			
			echo '<!-- - - - - - - - - - - - - - Product price & actions (only for list view) - - - - - - - - - - - - - - - - -->'."\xD\xA";
			echo '<div class="actions">';
			if (isset($item['discountPrice']))
				echo '<p class="product_price bold"><s>'.(isset($item['price'])?'$'.$item['price']:'').'</s> <b>'.(isset($item['discountPrice'])?'$'.$item['discountPrice']:'').'</b></p>';
			else
				echo '<p class="product_price bold">'.(isset($item['price'])?'$'.$item['price']:'').'</p>';
			echo '<ul class="seller_stats">';
			//echo '<li>Shipping: <span class="success">Free Shipping</span></li>';
			//echo '<li>Availability: <span class="success">in stock</span></li>';
			//echo '<li class="seller_info_wrap">';
			//echo 'Seller: <span class="seller_name">johnsmith</span>';
			echo '<div class="seller_info_dropdown">';
			echo '<ul class="seller_stats">';
			echo '<li>';			
			echo '<ul class="topbar">';								
			echo '<li>China (Mainland)</li>';
			echo '<li><a href="#">Contact Details</a></li>';
			echo '</ul>';
			echo '</li>';
			echo '<li><span class="bold">99.8%</span> Positive Feedback</li>';
			echo '</ul>';
			echo '<div class="v_centered">';
			echo '<a href="#" class="button_blue mini_btn">Contact Seller</a>';
			echo '<a href="#" class="small_link">Chat Now</a>';
			echo '</div>';
			echo '</div>';
			echo '</li>';
			echo '</ul>';
			echo '<ul class="buttons_col">';
			//echo '<li><a href="'.(isset($item['cartLink'])?$item['cartLink']:$href).'" class="button_blue middle_btn add_to_cart">Add to Cart</a></li>';
			//echo '<li><a href="'.(isset($item['wishlistLink'])?$item['wishlistLink']:$href).'" class="icon_link"><i class="icon-heart-5"></i>Add to Wishlist</a></li>';
			//echo '<li><a href="#" class="icon_link"><i class="icon-resize-small"></i>Add to Compare</a></li>';
			echo '</ul>';
			echo '</div>';
			echo '<!-- - - - - - - - - - - - - - Product price & actions (only for list view) - - - - - - - - - - - - - - - - -->'."\xD\xA";
			
			echo '</div><!--/ .product_item--></div>'."\xD\xA";
			echo '<!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->'."\xD\xA";
			
			if ($itemCount % $noOfRowItems == 0) {
				echo '</div><!--/ .table_row -->'."\xD\xA";
			}
		}
		if ($itemCount % $noOfRowItems != 0) {
			for ($i = 1; $i <= $noOfRowItems -($itemCount % $noOfRowItems); $i++) {
				echo '<div class="table_cell"><div class="product_item">'."\xD\xA";
				echo '</div><!--/ .product_item--></div>'."\xD\xA";
			}
			
			echo '</div><!--/ .table_row -->'."\xD\xA";
		}
	?>
</div><!--/ .table_layout -->
