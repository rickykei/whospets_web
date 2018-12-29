<?php
if(!isset($products)) 
	$products = Shop::getCartContent();
	
if(!isset($shoppingCart)) {
	$shoppingCart = new ShoppingCartForm;
	$shoppingCart->cart=$products;
	$shoppingCart->validate();
}
if (Yum::module())
		Yum::renderFlash();
	echo CHtml::errorSummary(array($shoppingCart)); 
?>
<!-- - - - - - - - - - - - - - Order review - - - - - - - - - - - - - - - - -->
<?php
if($products) {
?>
<section class="section_offset">
	<h3>Order Review</h3>
	<div class="table_wrap">
		<table class="table_type_1 order_review">
			<thead>
				<tr>
					<th class="product_title_col">Product Name</th>
					<th class="product_sku_col">Size</th>
					<th class="product_price_col">Price</th>
					<th class="product_qty_col">Quantity</th>
					<th class="product_total_col">Total</th>
				</tr>
			</thead>
			<tbody>
			<?php
				foreach($products as $position => $product) {
					if(@$model = Products::model()->findByPk($product['product_id'])) {
						$variations = '';
						if(isset($product['Variations'])) {
							foreach($product['Variations'] as $specification => $variation) {
								if($specification = ProductSpecification::model()->findByPk($specification)) {
									if($specification->input_type == 'textfield')
										$variation = $variation[0];
									else
										$variation = ProductVariation::model()->findByPk($variation);

									$variations = $variation->title . '<br />';
								} else {
									$variations .= CHtml::image(
											Yii::app()->baseUrl.'/'.$variation, '', array(
												'width' => Shop::module()->imageWidthThumb));
								}
							}
						}
						
						echo '<tr>';
						echo '<td data-title="Product Name">';
						echo '<a href="#" class="product_title">'.$model->title.'</a>';
						echo '</td>';
						echo '<td data-title="SKU">'.$variations.'</td>';
						echo '<td data-title="Price" class="subtotal">'.Shop::priceFormat($model->getPrice(@$product['Variations'])).'</td>';
						echo '<td data-title="Quantity">'.$product['amount'].'</td>';
						echo '<td data-title="Total" class="total">'.Shop::priceFormat($model->getPrice(@$product['Variations'], @$product['amount'])).'</td>';
						echo '</tr>';
					}
				}
			
			?>				
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" class="bold">Subtotal</td>
					<td class="total"><?php echo Shop::priceFormat(Shop::getTotalProductPriceAmt()); ?></td>
				</tr>
				<tr>
					<td colspan="4" class="bold">Shipping &amp; Heading (Flat Rate - Fixed)</td>
					<td class="total">
					<?php
						$shippingOption=Shop::getCartShippingMethods();
						//echo Shop::priceFormat($shippingOption->fee);
						echo Shop::getShippingMethod(true);
					?>
					</td>
				</tr>
				<tr>
					<td colspan="4" class="grandtotal">Grand Total</td>
					<td class="grandtotal"><?php echo Shop::priceFormat(Shop::getTotalPriceAmt()); ?></td>
				</tr>
			</tfoot>
		</table>
	</div><!--/ .table_wrap -->
	
	<div class="theme_box">
	<?php
		if (!$skipAddress) {
		$deliveryAddress=$customer->deliveryAddress;
		$billingAddress=$customer->billingAddress;
	?>
		<div class="col-2-layout">
			<ul>
				<li class="row">
					<div class="col-sm-6">
						<div class="bold">Shipping address</div>
						<ul>
						<li><?php echo $deliveryAddress->firstname.' '.$deliveryAddress->lastname; ?></li>
						<li><?php echo $deliveryAddress->street; ?></li>
						<li><?php echo $deliveryAddress->city; ?></li>
						<li><?php echo Shop::module()->validCountries[$deliveryAddress->country]; ?></li>
						<li><?php echo Shop::module()->validStates[$deliveryAddress->state]; ?></li>
						<li><?php echo $deliveryAddress->zipcode; ?></li>
						<li><?php echo $deliveryAddress->phone; ?></li>
						</ul>
					</div><!--/ [col] -->
					<div class="col-sm-6">
						<div class="bold">Billing address</div>
						<ul>
						<li><?php echo $billingAddress->firstname.' '.$billingAddress->lastname; ?></li>
						<li><?php echo $billingAddress->street; ?></li>
						<li><?php echo $billingAddress->city; ?></li>
						<li><?php echo Shop::module()->validCountries[$billingAddress->country]; ?></li>
						<li><?php echo Shop::module()->validStates[$billingAddress->state]; ?></li>
						<li><?php echo $billingAddress->zipcode; ?></li>
						<li><?php echo $billingAddress->phone; ?></li>
						</ul>
					</div><!--/ [col] -->
				</li>
			</ul>
		</div>
	<?php 
		}
	?>
		<br>
		<?php		
		echo '<h3>'.Shop::t('Please add additional comments to the order here').'</h3>'; 
		echo CHtml::textArea('Order[Comment]',
			@Yii::app()->user->getState('order_comment'), array(
				'class' => 'order_comment'));
		?>
	</div>
	
	<footer class="bottom_box on_the_sides">
		<div class="left_side v_centered">
			<span>Forgot an item?</span>
			<a href="<?php echo Yii::app()->createUrl('//shop/shoppingCart/view');?>" class="button_grey middle_btn">Edit Your Cart</a>
		</div>
		<div class="right_side">
			<input class="button_blue middle_btn" type="submit" value="Submit Order">
		</div>
	</footer>
</section>
<?php
} else {
echo Shop::t('Your shopping cart is empty'); 
?>
<br><br>
<a class="colors-btn" href="<?php echo Yii::app()->createUrl("/shop/products");?>" title="Continue shopping"><span><span>Continue shopping</span></span></a>
<?php
}
?>
<!-- - - - - - - - - - - - - - End of order review - - - - - - - - - - - - - - - - -->
