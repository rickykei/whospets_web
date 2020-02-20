<div class="secondary_page_wrapper">
	<div class="container">
		<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->
		<?php
			$this->widget('application.components.widgets.BreadcrumbsWidget',array(
								'items'=>array(
												array('description'=>'Home', 'href'=>Yii::app()->createUrl('/site/index'),),
												array('description'=>'Search'),
											)
							)
						);
		?>
		<div class="row">
			<aside class="col-md-3 col-sm-4 has_mega_menu">
				<!-- - - - - - - - - - - - - - Categories - - - - - - - - - - - - - - - - -->
				<!-- - - - - - - - - - - - - - End of categories - - - - - - - - - - - - - - - - -->

				<!-- - - - - - - - - - - - - - Filter - - - - - - - - - - - - - - - - -->
				<?php $form=$this->beginWidget('CActiveForm', array(
								'action'=>Yii::app()->createUrl($this->route),
								'method'=>'get',
							)); 
				?>
				<?php $this->renderPartial('shop.views.productSearchForm._search_vertical',array(
								'model'=>$searchForm,
								'form'=>$form,
							)); 
				?>
				<!-- - - - - - - - - - - - - - End of filter - - - - - - - - - - - - - - - - -->
			</aside>

			<main class="col-md-9 col-sm-8">
				<section class="section_offset">
					<h1>Search</h1>
				</section>
				<!-- - - - - - - - - - - - - - Products - - - - - - - - - - - - - - - - -->
				<div class="section_offset">
					<header class="top_box on_the_sides">
						<div class="left_side clearfix v_centered">
							<!-- - - - - - - - - - - - - - Sort by - - - - - - - - - - - - - - - - -->
							<div class="v_centered">
								<span>Sort by:</span>
								<div class="">
									<?php
										echo $form->dropDownList($searchForm, 'sorting', array(''=>'Default', 'price'=>'Price', 'newest'=>'Date'));
									?>
								</div>
							</div>
							<!-- - - - - - - - - - - - - - End of sort by - - - - - - - - - - - - - - - - -->
							<!-- - - - - - - - - - - - - - Number of products shown - - - - - - - - - - - - - - - - -->
							<!--<div class="v_centered">
								<span>Show:</span>
								<div class="custom_select">
									<select name="">
										<option value="15">15</option>
										<option value="12">12</option>
										<option value="9">9</option>
										<option value="6">6</option>
										<option value="3">3</option>
									</select>
								</div>
							</div>-->
							<!-- - - - - - - - - - - - - - End of number of products shown - - - - - - - - - - - - - - - - -->
						</div>
						<div class="right_side">
							<!-- - - - - - - - - - - - - - Product layout type - - - - - - - - - - - - - - - - -->
							<div class="layout_type buttons_row" data-table-container="#products_container">
								<a href="#" data-table-layout="grid_view" class="button_grey middle_btn icon_btn active tooltip_container"><i class="icon-th"></i><span class="tooltip top">Grid View</span></a>
								<a href="#" data-table-layout="list_view list_view_products" class="button_grey middle_btn icon_btn tooltip_container"><i class="icon-th-list"></i><span class="tooltip top">List View</span></a>
							</div>
							<!-- - - - - - - - - - - - - - End of product layout type - - - - - - - - - - - - - - - - -->
						</div>
					</header>

					<?php
						$image_folder = Shop::module()->productImagesFolder;
						$products = array();
						$dataProvider=$searchForm->search();
						
						foreach($dataProvider->getData() as $product){
							$default_image=$product->getDefaultImage();
							$images=$product->images;
							if($default_image){
								$image_link=Yii::app()->baseUrl.'/'.$image_folder.'/'.$default_image->filename;
							}else{
								if($images)
									$image_link=Yii::app()->baseUrl.'/'.$image_folder.'/'.current($images)->filename;
								else
									$image_link=Shop::register('no-pic.jpg');
							}
							$products[] = array(
								'title'=>$product->title,
								'image'=>$image_link,
								//'quickViewLink'=>Yii::app()->createUrl('/shop/products/view',array('id' => $product->product_id)),
								'href'=>Yii::app()->createUrl('/shop/products/view',array('id' => $product->product_id)),
								//'cartLink'=>Yii::app()->createUrl('/shop/shoppingCart/quickCreate',array('product_id' => $product->product_id)),
								//'wishlistLink'=>Yii::app()->createUrl('/shop/wishlist/update',array('product_id' => $product->product_id)),
								'price'=>$product->price,
							);
						}			
						
						$this->widget('application.components.widgets.ProductTableWidget',array(
									'items'=>$products,
								)
							);
							
						$this->widget('application.components.widgets.ProductTablePagerWidget',array(
									'currentPage'=>$dataProvider->pagination->getCurrentPage(),
									'itemCount'=>$dataProvider->totalItemCount,
									'pageSize'=>$dataProvider->pagination->pageSize,
									'maxButtonCount'=>5,
									//'nextPageLabel'=>'>>',
									//'prevPageLabel'=>'<<',
								)
							);
					?>
					<?php $this->endWidget(); ?>
				</div>
				<!-- - - - - - - - - - - - - - End of products - - - - - - - - - - - - - - - - -->
			</main>
		</div><!--/ .row -->
	</div><!--/ .container-->
</div><!--/ .page_wrapper-->