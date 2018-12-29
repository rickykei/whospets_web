<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->
<div class="secondary_page_wrapper">
	<div class="container">
		<?php
			if(!isset($products)) 
				$products = Shop::getCartContent();
				
			if(!isset($shoppingCart)) {
				$shoppingCart = new ShoppingCartForm;
				$shoppingCart->cart=$products;
				$shoppingCart->validate();
			}
			$this->widget('application.components.widgets.BreadcrumbsWidget',array(
								'items'=>array(
												array('description'=>'Home', 'href'=>Yii::app()->createUrl('/site/index'),),
												array('description'=>'Shopping Cart'),
											)
							)
						);
		?>
		<section class="section_offset">
			<h1>Shopping Cart</h1>
			<?php 

				if (Yum::module())
					Yum::renderFlash();
				echo CHtml::errorSummary(array($shoppingCart)); 		

			?>
			<!-- - - - - - - - - - - - - - Shopping cart table - - - - - - - - - - - - - - - - -->
			<?php
				$image_folder = Shop::module()->productImagesFolder;
				$items = array();
						
				if($products) {
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

										if(Shop::module()->allowPositionLiveChange) {
											if($specification->input_type == 'select') {
												$name = sprintf('variation_%s_%s',$position, $specification->id); 
												//$name = "Variations[{$specification->id}][{$position}]";
												//$variations .= CHtml::radioButtonList(
												//		$name, $variation->id,
												//		ProductVariation::listData($variation->getVariations(), true));
												$variations .=  CHtml::dropDownList(
														$name, $variation->id,
														ProductVariation::listSimpleVar($variation->getVariations()));
												Yii::app()->clientScript->registerScript($name, "
														$('[name=\"".$name."\"]').click(function(){
													$.ajax({
															'url' : '".CController::createUrl('//shop/shoppingCart/updateVariation')."',
															'type' : 'POST',
															'data' : $(this),
															error: function() {
															$('#amount_".$position."').css('background-color', 'red');
															},
															success: function(result) {
															$('.amount_".$position."').css('background-color', 'lightgreen');
															//$('.widget_amount_".$position."').css('background-color', 'lightgreen');
															//$('.widget_amount_".$position."').html($('.amount_".$position."').val());
															$('.price_".$position."').html(result);	
															$('.price_single_".$position."').load('".$this->createUrl(
														'//shop/shoppingCart/getPriceSingle',array('position'=>$position))."');
															$('.price_total').load('".$this->createUrl(
														'//shop/shoppingCart/getPriceTotal')."');
															$('.shipping_costs').load('".$this->createUrl(
														'//shop/shoppingCart/getShippingCosts')."');

															},
															});
														});
														");
												$variations .= '<br />';
											}
										} else
											$variations .= $specification . ': ' . $variation . '<br />';
									} else {
										$variations .= CHtml::image(
												Yii::app()->baseUrl.'/'.$variation, '', array(
													'width' => Shop::module()->imageWidthThumb));
									}
								}
							}

						
							$default_image=$model->getDefaultImage();
							$images=$model->images;
							if($default_image){
								$image_link=Yii::app()->baseUrl.'/'.$image_folder.'/'.$default_image->filename;
							}else{
								if($images)
									$image_link=Yii::app()->baseUrl.'/'.$image_folder.'/'.current($images)->filename;
								else
									$image_link=Shop::register('no-pic.jpg');
							}
							$items[] = array('image'=>$image_link,
									'href'=>Yii::app()->createUrl('/shop/products/view',array('id' => $model->product_id)),
									'name'=>$model->title,
									'size'=>$variations,
									'price'=>Shop::priceFormat($model->getPrice(@$product['Variations'])),
									'total'=>Shop::priceFormat($model->getPrice(@$product['Variations'], @$product['amount'])),
									'quantity'=>$product['amount'],
									'removeLink'=>Yii::app()->createUrl('/shop/shoppingCart/delete', array('id' => $position)),
									);
									
							Yii::app()->clientScript->registerScript('amount_'.$position,"
								$('.amount_".$position."').on('input propertychange', function() {
									$.ajax({
										url:'".$this->createUrl('//shop/shoppingCart/updateAmount')."',
										data: $('#amount_".$position."'),
										success: function(result) {
										$('.amount_".$position."').css('background-color', 'lightgreen');
										//$('.widget_amount_".$position."').css('background-color', 'lightgreen');
										//$('.widget_amount_".$position."').html($('.amount_".$position."').val());
										$('.price_".$position."').html(result);	
										$('.price_total').load('".$this->createUrl(
										'//shop/shoppingCart/getProductPriceTotal')."');
										$('.grand_total').load('".$this->createUrl(
										'//shop/shoppingCart/getProductPriceTotal')."');
										$('.shipping_costs').load('".$this->createUrl(
										'//shop/shoppingCart/getShippingCosts')."');

										},
										error: function() {
										$('#amount_".$position."').css('background-color', 'red');
										},

										});
							});
								");
						}
					}
				}
				$this->widget('application.components.widgets.ShoppingCartTableWidget',array(
									'items'=>$items,
								)
							);
							
				
				//include('_left_menu.php');
				//$this->renderPartial('/profile/_form', array('profile' => $profile, 'user'=>$user, 'changePassword'=>$changePassword)); 
			?>
			<footer class="bottom_box on_the_sides">
				<div class="left_side">
					<a href="<?php echo Yii::app()->createUrl("/shop/products");?>" class="button_blue middle_btn">Continue Shopping</a>
				</div>
				<div class="right_side">
					<!-- <a href="#" class="button_grey middle_btn">Clear Shopping Cart</a> -->
				</div>
			</footer><!--/ .bottom_box -->
			<!-- - - - - - - - - - - - - - End of shopping cart table - - - - - - - - - - - - - - - - -->
		</section><!--/ .section_offset -->
		<?php
			if (Shop::getCartContent()){
		?>
		<div class="section_offset">
			<div class="row">
				<section class="col-sm-4"></section>
				<section class="col-sm-4"></section>
				<section class="col-sm-4">
					<h3>Total</h3>
					<div class="table_wrap">
						<table class="zebra">
							<tfoot>
								<tr>
									<td>Subtotal</td>
									<td><div class="price_total"><?php echo Shop::priceFormat(Shop::getTotalProductPriceAmt()); ?></div></td>
								</tr>
								<tr class="total">
									<td>Total</td>
									<td><div class="grand_total"><?php echo Shop::priceFormat(Shop::getTotalProductPriceAmt()); ?></div></td>
								</tr>
							</tfoot>
						</table>
					</div>
					<footer class="bottom_box">
						<a class="button_blue middle_btn" href="<?php echo Yii::app()->createUrl("/shop/order/create");?>">Proceed to Checkout</a>
						<div class="single_link_wrap">
							<!-- <a href="#">Checkout with Multiple Addresses</a> -->
						</div>
					</footer>
				</section><!-- / [col] -->
			</div><!--/ .row -->
		</div><!--/ .section_offset -->
		<?php } ?>
	</div><!--/ .container-->
</div><!--/ .page_wrapper-->			
<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->