<section class="section_offset animated transparent" data-animation="fadeInDown">
<?php
	$const_style_sixItems='six_items';
	$const_style_fiveItems='five_items';
	$const_style_fourItems='four_items';
	$style_noOfItems=$const_style_sixItems;
	
	if (isset($noOfItems)){
		$style_noOfItems=$const_style_sixItems;
		switch ($noOfItems) {
			case 4:
				$style_noOfItems=$const_style_fourItems;
				break;
			case 5:
				$style_noOfItems=$const_style_fiveItems;
				break;
		}
	}
	
	if (isset($title)) {
		echo '<h3 class="'.(isset($title['class'])?$title['class']:'').' offset_title">'.(isset($title['description'])?$title['description']:'').'</h3>'."\xD\xA";
		echo '<!-- - - - - - - - - - - - - - Carousel of '.(isset($title['description'])?$title['description']:'').' - - - - - - - - - - - - - - - - -->'."\xD\xA";
	}
	echo '<div class="owl_carousel '.$style_noOfItems.'">';
	
	$description='';
	$href='#';
	$itemCount=0;
	foreach($items as $item) {
		$itemCount++;
		// Product
		echo "\xD\xA".'<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->'."\xD\xA";
		echo '<div class="product_item type_3">';
		
			// Thumbnail
			echo '<div class="image_wrap">';
			
				// Image
				echo '<p><a href="'.(isset($item['href'])?$item['href']:$href).'">';
				echo '<img src="'.(isset($item['image'])?$item['image']:'').'" alt="">';
				echo '</a>';
				// Product actions
				//echo '<div class="actions_wrap">';
				
					//echo '<button class="button_dark_grey def_icon_btn add_to_wishlist tooltip_container alignleft" onclick="javascript:location.href='."'".(isset($item['wishlistLink'])?$item['wishlistLink']:$href)."'".'"><span class="tooltip right">Add to Wishlist</span></button>';
					//echo '<button class="button_dark_grey def_icon_btn add_to_compare tooltip_container alignleft"><span class="tooltip top">Add to Compare</span></button>';
					//echo '<button class="button_dark_grey def_icon_btn quick_view_product tooltip_container alignleft" data-modal-url="modals/quick_view.html"><span class="tooltip top">Quick View</span></button>';
					//echo '<button class="button_dark_grey def_icon_btn quick_view_product tooltip_container alignleft" onclick="javascript:location.href='."'".(isset($item['href'])?$item['href']:$href)."'".'"><span class="tooltip top">Quick View</span></button>';
					//echo '<button class="button_blue def_icon_btn add_to_cart tooltip_container alignright" onclick="javascript:location.href='."'".(isset($item['cartLink'])?$item['cartLink']:$href)."'".'"><span class="tooltip left">Add to Cart</span></button>';
				
				//echo '</div><!--/ .actions_container-->'."\xD\xA";
			
			echo '</div><!--/. image_wrap-->'."\xD\xA";
			
			// Label
			if (isset($item['label'])){
				echo '<!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->'."\xD\xA";
				if (isset($item['label']['type'])){
					switch (strtolower($item['label']['type'])) {
						case 'discount':
							echo '<div class="label_offer percentage"><div>'.$item['label']['value'].'</div>OFF</div>';
							break;
						case 'new':
							echo '<div class="label_new">New</div>';
							break;
						case 'hot':
							echo '<div class="label_hot">HOT</div>';
							break;
						case 'bestseller':
							echo '<div class="label_bestseller">Bestseller</div>';
					}
				}
				echo '<!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->'."\xD\xA";
			}
			
			// Countdown
			echo "\xD\xA".'<!-- - - - - - - - - - - - - - Countdown - - - - - - - - - - - - - - - - -->'."\xD\xA";
			if (isset($item['countdownEndDate'])){
				// yyyymmddhhmmss
				$date = new DateTime($item['countdownEndDate']);
				$yr = (int)$date->format('Y');
				$month = (int)$date->format('m')-1;
				$day = (int)$date->format('d');
				$hr = (int)$date->format('H');
				$min = (int)$date->format('i');
				$sec = (int)$date->format('s');
				if($title['description']!="Recent Found Pets")
				echo '<div class="countdown" data-year="'.$yr.'" data-month="'.$month.'" data-day="'.$day.'" data-hours="'.$hr.'" data-minutes="'.$min.'" data-seconds="'.$sec.'">ddfdf</div>';
				else
			 	echo "Date Found : ".$yr."-".++$month."-".$day;	
			}
			echo "\xD\xA".'<!-- - - - - - - - - - - - - - End countdown - - - - - - - - - - - - - - - - -->'."\xD\xA";
			
			// Product description
			echo "\xD\xA".'<!-- - - - - - - - - - - - - - Product description - - - - - - - - - - - - - - - - -->'."\xD\xA";
			echo '<div class="description">';
			echo '<p><a href="'.(isset($item['href'])?$item['href']:$href).'">'.(isset($item['description'])?$item['description']:$description).'</a></p>';
			echo '<div class="clearfix product_info">';
			

			/* amend 5b 20160322
			if (isset($item['discountPrice']))
				echo '<p class="product_price"><s>'.(isset($item['price'])?'$'.$item['price']:'').'</s> <b>'.(isset($item['discountPrice'])?'$'.$item['discountPrice']:'').'</b></p>';
			else
				echo '<p class="product_price"><b>'.(isset($item['price'])?'$'.$item['price']:'').'</b></p>';

			amend 5b 20160322*/

			echo "\xD\xA".'<!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->'."\xD\xA";
			if (isset($item['rating'])){
				echo '<ul class="rating">';
				for ($i = 1; $i <= 5; $i++) {
					if ($i<=$item['rating'])
						echo '<li class="active"></li>';
					else
						echo '<li></li>';
				}
				echo '</ul>';
			}
			echo "\xD\xA".'<!-- - - - - - - - - - - - - - End product rating - - - - - - - - - - - - - - - - -->'."\xD\xA";
			echo '</div><!--/ .clearfix.product_info-->'."\xD\xA";
			echo '</div>';
			
			echo '<!-- - - - - - - - - - - - - - End of product description - - - - - - - - - - - - - - - - -->'."\xD\xA";
			
		echo '</div><!--/ .product_item-->'."\xD\xA";
		echo '<!-- - - - - - - - - - - - - - End product - - - - - - - - - - - - - - - - -->'."\xD\xA";
		
	}
	echo '</div><!--/ .owl_carousel-->'."\xD\xA";
	if (isset($title))
		echo '<!-- - - - - - - - - - - - - - End of carousel of '.(isset($title['description'])?$title['description']:'').' - - - - - - - - - - - - - - - - -->'."\xD\xA";
?>
</section><!--/ .section_offset.animated.transparent-->
