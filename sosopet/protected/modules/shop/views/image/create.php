<section class="content-wrapper">
	<div class="content-container container">
		<?php 
			$this->widget('application.components.widgets.ProfileBreadcrumbsWidget',array(
					'items'=>array(
						'Your Store'=>'',
						'Upload Product Image'=>'',
					),
				)
			);
			$this->renderPartial('shop.views.layouts._left_menu');			
		?>	
		
		
		<div class="col-main">
			<div class="main">
				<div class="product-info-box">
					<div class="product-img-box container">
					<?php 
						$slides = array();
						$slide_count = 0;
						if($images) {
							$folder = Shop::module()->productImagesFolder;
							foreach($images as $image) {
								$slide_count++;
								$slides['slide'.$slide_count] = array(
									'id'=>'slide1.'.$slide_count,
									'content'=>'<img src="'.Yii::app()->baseUrl.'/'.$folder.'/'.$image->filename.'" />',
									'thumb'=>Yii::app()->baseUrl.'/'.$folder.'/'.$image->filename,
								);
								//$this->renderPartial('/image/view', array( 'model' => $image));
								//echo '<br />'; 
								
							}
							if($slide_count==1){
								$this->widget('ext.xflexslider.XFlexSlider',array(
									'slides'=>$slides,
								 
									'flexsliderOptions'=>array(
										//'animation' => '"slide"',
										'slideDirection' => 'vertical',
										//'mousewheel' => true,
										//'controlNav' => 'thumbnails',
										'controlNav' => false,
										//'sync' => '#carousel',
										//'start' => 'function(slider){$("body").removeClass("loading");}',
									),
									
									'htmlOptions'=>array(
										'id'=>'slider1',
										//'style'=>'width:630px;height:100px;',
									),
								));
							}else{
								$this->widget('ext.xflexslider.XFlexSlider',array(
									'slides'=>$slides,
								 
									'flexsliderOptions'=>array(
										//'animation' => '"slide"',
										'slideDirection' => 'vertical',
										//'mousewheel' => true,
										//'controlNav' => 'thumbnails',
										'controlNav' => false,
										//'sync' => '#carousel',
										//'start' => 'function(slider){$("body").removeClass("loading");}',
									),
									
									'thumbsliderOptions'=>array(
										'id' => 'carousel',
										'animation' => '"slide"',
										'controlNav' => false,
										'animationLoop' => false,
										'slideshow' => false,
										'itemWidth' => 80,
										'itemMargin' => 5,
										//'asNavFor' => '#slider',
									),
									
									'htmlOptions'=>array(
										'id'=>'slider1',
										//'style'=>'width:630px;height:100px;',
									),
								));
							}
						} else {
							echo CHtml::image(Shop::register('no-pic.jpg'));
						}
					?>
					</div>
					
					<div class="product-shop">
						<?php
						$this->breadcrumbs=array(
							Shop::t('Images') =>array('index'),
							Shop::t('Upload'),
						);

						?>

						<div id="shopcontent">

							<h2> <?php Shop::t('Upload Image'); ?></h2>

						<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

						</div>
					</div>
					
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<br>
	</div>
</section>  