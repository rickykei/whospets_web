<div class="table_wrap">
	<table class="table_type_1 shopping_cart_table">
		<thead>
			<tr>
				<th class="product_image_col">Product Image</th>
				<th class="product_title_col">Product Name</th>
				<!-- <th>SKU</th> -->
				<th>Size</th>
				<th>Price</th>
				<th class="product_qty_col">Quantity</th>
				<th>Total</th>
				<th class="product_actions_col">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
			
			$href='#';
			$image='#';
			$name='';
			$size='';
			$price='';
			$total='';
			$quantity='';
			$count=0;
			
			foreach($items as $item) {
					echo '<tr>'."\xD\xA";
					echo '<!-- - - - - - - - - - - - - - Product Image - - - - - - - - - - - - - - - - -->'."\xD\xA";
					echo '<td class="product_image_col" data-title="Product Image">';
					echo '<a href="#"><img src="'.(isset($item['image'])?$item['image']:$image).'" alt=""></a>';
					echo '</td>'."\xD\xA";
					echo '<!-- - - - - - - - - - - - - - End of product Image - - - - - - - - - - - - - - - - -->'."\xD\xA";
					
					echo '<!-- - - - - - - - - - - - - - Product name - - - - - - - - - - - - - - - - -->'."\xD\xA";
					echo '<td data-title="Product Name">';
					echo '<a href="'.(isset($item['href'])?$item['href']:$href).'" class="product_title">'.(isset($item['name'])?$item['name']:$name).'</a>';
					//echo '<ul class="sc_product_info">';
					//echo '<li>Size: Big</li>';
					//echo '<li>Color: Red</li>';
					//echo '</ul>';
					echo '</td>'."\xD\xA";
					echo '<!-- - - - - - - - - - - - - - End of product name - - - - - - - - - - - - - - - - -->'."\xD\xA";
					
					//echo '<!-- - - - - - - - - - - - - - SKU - - - - - - - - - - - - - - - - -->'."\xD\xA";
					//echo '<td data-title="SKU">';
					//echo 'PS01';
					//echo '</td>'."\xD\xA";
					//echo '<!-- - - - - - - - - - - - - - End of SKU - - - - - - - - - - - - - - - - -->'."\xD\xA";
					
					echo '<!-- - - - - - - - - - - - - - SKU - - - - - - - - - - - - - - - - -->'."\xD\xA";
					echo '<td data-title="SKU">';
					echo (isset($item['size'])?$item['size']:$size);
					echo '</td>'."\xD\xA";
					echo '<!-- - - - - - - - - - - - - - End of SKU - - - - - - - - - - - - - - - - -->'."\xD\xA";
					
					echo '<!-- - - - - - - - - - - - - - Price - - - - - - - - - - - - - - - - -->'."\xD\xA";
					echo '<td class="subtotal price_single_'.$count.'" data-title="Price">';
					echo (isset($item['price'])?$item['price']:$price);
					echo '</td>'."\xD\xA";
					echo '<!-- - - - - - - - - - - - - - End of Price - - - - - - - - - - - - - - - - -->'."\xD\xA";
					
					echo '<!-- - - - - - - - - - - - - - Quantity - - - - - - - - - - - - - - - - -->'."\xD\xA";
					echo '<td data-title="Quantity">';
					echo '<div class="qty min clearfix">';
					echo '<button id="btn_amount_minus_'.$count.'" class="theme_button" data-direction="minus">&#45;</button>';
					echo '<input type="text" class="amount_'.$count.'" id="amount_'.$count.'" name="amount_'.$count.'" value="'.(isset($item['quantity'])?$item['quantity']:$quantity).'">';
					echo '<button id="btn_amount_plus_'.$count.'" class="theme_button" data-direction="plus">&#43;</button>';
					echo '</div><!--/ .qty.min.clearfix-->';
					echo '</td>'."\xD\xA";
					echo '<!-- - - - - - - - - - - - - - End of quantity - - - - - - - - - - - - - - - - -->'."\xD\xA";
					
					echo '<!-- - - - - - - - - - - - - - Total - - - - - - - - - - - - - - - - -->'."\xD\xA";
					echo '<td class="total price_'.$count.'" data-title="Total">';
					echo (isset($item['total'])?$item['total']:$total);
					echo '</td>'."\xD\xA";
					echo '<!-- - - - - - - - - - - - - - End of total - - - - - - - - - - - - - - - - -->'."\xD\xA";
					
					echo '<!-- - - - - - - - - - - - - - Action - - - - - - - - - - - - - - - - -->'."\xD\xA";
					echo '<td data-title="Action">';
					//echo '<a href="#" class="button_dark_grey icon_btn edit_product"><i class="icon-pencil"></i></a>';
					echo '<a href="'.(isset($item['removeLink'])?$item['removeLink']:$href).'" class="button_dark_grey icon_btn remove_product"><i class="icon-cancel-2"></i></a>';
					echo '</td>'."\xD\xA";
					echo '<!-- - - - - - - - - - - - - - End of action - - - - - - - - - - - - - - - - -->'."\xD\xA";
					
					echo '</tr>'."\xD\xA";
					echo '<script>';
					echo 'jQuery(function(){';
					//echo '$('."'".'#btn_amount_minus_'.$count."'".').on('."'".'click'."'".', function() {$('."'".'.amount_'.$count."'".').trigger('."'".'input'."'".');});';
					//echo '$('."'".'#btn_amount_plus_'.$count."'".').on('."'".'click'."'".', function() {$('."'".'.amount_'.$count."'".').trigger('."'".'input'."'".');});';
					echo '$('."'".'#btn_amount_minus_'.$count."'".').on('."'".'click'."'".', function() {$('."'".'.amount_'.$count."'".').focus();';
					echo '$('."'".'#btn_amount_plus_'.$count."'".').on('."'".'click'."'".', function() {$('."'".'.amount_'.$count."'".').focus();';
					echo '});';
					echo '</script>';
					$count = $count + 1;
			}
		?>
		</tbody>
	</table>
</div><!--/ .table_wrap -->
