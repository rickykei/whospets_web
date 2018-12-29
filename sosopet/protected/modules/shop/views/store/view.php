<section class="content-wrapper">
	<div class="content-container container">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'action'=>Yii::app()->createUrl($this->route),
			'method'=>'get',
		)); ?>
		<div class="col-left">
			<div class="block man-block">
			<div class="block-title"><?php echo $model->store_name; ?></div>
			<?php 
				echo $model->getStoreLogo();
			?>
			<p> Seller Name: <?php echo $model->user->profile->firstname.' '.$model->user->profile->lastname;?></p>
			<p> Feedback: <a href="<?php echo Yii::app()->createUrl('/shop/store/feedback',array('id' => $model->id)); ?>"><?php echo $model->getFeedback();?>%</a></p>
			</div>
			<div class="block shop-by-block">
				<div class="block-title">
				<?php echo CHtml::link('Favorite Store',Yii::app()->createUrl('/shop/favorite/update',array('store_id' => $model->id))); ?>
				</div>
			</div>
			<div class="block shop-by-block">
			<?php
				$this->widget('zii.widgets.jui.CJuiAccordion',array(
					'panels'=>array(
						'About Store'=>$model->store_description,
						'Shipping Policy'=>$model->shipping_info,
						'Payment / Refund Policy'=>$model->policy,
						// panel 3 contains the content rendered by a partial view
						//'panel 3'=>$this->renderPartial('_renderpage',null,true),
					),
					// additional javascript options for the accordion plugin
					'options'=>array(
						'collapsible'=> true,
						'animated'=>'bounceslide',
						'autoHeight'=>false,
						'active'=>2,
						'icons'=>array(
							"header"=>"ui-icon-plus",//ui-icon-circle-arrow-e
							"headerSelected"=>"ui-icon-circle-arrow-s",//ui-icon-circle-arrow-s, ui-icon-minus
						),
					),
				));
			?>
			</div>
			<br>
			<?php $this->renderPartial('shop.views.productSearchForm._search_vertical',array(
				'model'=>$searchForm,
				'form'=>$form,
			)); ?>
			<!-- search-form -->
		</div>
		<div class="col-main">
		<div class="new-product-block">
		<div class="category-banner">
			<?php 
				echo $model->getStoreBanner();
			?>
		</div>
		<div class="pager-container">
				<?php $this->renderPartial('shop.views.productSearchForm._search_vertical_top',array(
					'model'=>$searchForm,
					'form'=>$form,
				)); ?>
			</div>
		
		<?php $this->endWidget(); ?>
		<?php
			$image_folder = Shop::module()->productImagesFolder;
			$newProductsItems = array();
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
				$newProductsItems[] = array(
					'name'=>$product->title,
					'imgLink'=>$image_link,
					'quickViewLink'=>Yii::app()->createUrl('/shop/products/view',array('id' => $product->product_id)),
					'detailViewLink'=>Yii::app()->createUrl('/shop/products/view',array('id' => $product->product_id)),
					'cartLink'=>Yii::app()->createUrl('/shop/shoppingCart/quickCreate',array('product_id' => $product->product_id)),
					'wishlistLink'=>Yii::app()->createUrl('/shop/wishlist/update',array('product_id' => $product->product_id)),
					'price'=>$product->price,
				);
			}			
			// pager2 (bottom)
			echo '<div class="pagination">';
			$this->widget('application.components.widgets.ProductGrid', array('products'=>$newProductsItems,'size'=>3,));
			$this->widget('CLinkPager', array(
				'id'=>'pager_bottom',
				'currentPage'=>$dataProvider->pagination->getCurrentPage(),
				'itemCount'=>$dataProvider->totalItemCount,
				'pageSize'=>$dataProvider->pagination->pageSize,
				'maxButtonCount'=>5,
				'nextPageLabel'=>'>>',
				'prevPageLabel'=>'<<',
				'header'=>'',
				//'htmlOptions'=>array('class'=>'yiiPager'),
			));
			echo '</div>';
		?>
		</div>
		</div>
	</div>
</section>
<div class="clear"> </div>
<br>
<br>