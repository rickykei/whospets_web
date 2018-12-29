<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/common.js"></script>
<?php $this->pageTitle=Yii::app()->name; ?>
<!-- Banner Section -->
<section class="banner-wrapper">
	<div class="banner-block container">
<?php
$flex_datasource=$model->searchTop10();
echo Yii::trace(CVarDumper::dumpAsString($flex_datasource->getData()),'vardump');
echo Yii::trace(CVarDumper::dumpAsString($flex_datasource->getData()[0]->description),'vardump');
//echo Yii::trace(CVarDumper::dumpAsString($flex_datasource->getData()[0]->images),'vardump');

$this->widget('ext.xflexslider.XFlexSlider',array(
    'slides'=>array(
        //use content
        'slide1' => array(
            'id'=>'slide1.1',
            'content'=>'<img src="' . Yii::app()->request->baseUrl . '/productimages/banner1.jpg" />',
			'thumb'=>Yii::app()->request->baseUrl.'/productimages/banner1.jpg',
        ),
		'slide2' => array(
            'id'=>'slide1.2',
            'content'=>'<img src="' . Yii::app()->request->baseUrl . '/productimages/banner2.jpg" />',
			'thumb'=>Yii::app()->request->baseUrl.'/productimages/banner2.jpg',
        ),
		'slide3' => array(
            'id'=>'slide1.3',
            'content'=>'<img src="' . Yii::app()->request->baseUrl . '/productimages/banner3.jpg" />',
			'thumb'=>Yii::app()->request->baseUrl.'/productimages/banner3.jpg',
        ),
		'slide4' => array(
            'id'=>'slide1.4',
            'content'=>'<img src="' . Yii::app()->request->baseUrl . '/productimages/banner4.jpg" />',
			'thumb'=>Yii::app()->request->baseUrl.'/productimages/banner4.jpg',
        ),
    ),
 
    'flexsliderOptions'=>array(
		'animation' => '"slide"',
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

$this->widget('ext.xflexslider.XFlexSlider',array(
    'slides'=>array(
        //use content
        'slide1' => array(
            'id'=>'slide2.1',
            'content'=>'<img src="' . Yii::app()->request->baseUrl . '/productimages/banner1.jpg" />',
			'thumb'=>Yii::app()->request->baseUrl.'/productimages/banner1.jpg',
        ),
		'slide2' => array(
            'id'=>'slide2.2',
            'content'=>'<img src="' . Yii::app()->request->baseUrl . '/productimages/banner2.jpg" />',
			'thumb'=>Yii::app()->request->baseUrl.'/productimages/banner2.jpg',
        ),
		'slide3' => array(
            'id'=>'slide2.3',
            'content'=>'<img src="' . Yii::app()->request->baseUrl . '/productimages/banner3.jpg" />',
			'thumb'=>Yii::app()->request->baseUrl.'/productimages/banner3.jpg',
        ),
		'slide4' => array(
            'id'=>'slide2.4',
            'content'=>'<img src="' . Yii::app()->request->baseUrl . '/productimages/banner4.jpg" />',
			'thumb'=>Yii::app()->request->baseUrl.'/productimages/banner4.jpg',
        ),
    ),
 
    'flexsliderOptions'=>array(
		'animation' => '"slide"',
		'slideDirection' => 'vertical',
        //'mousewheel' => true,
		//'controlNav' => 'thumbnails',
		'controlNav' => false,
		//'sync' => '#carousel',
		//'start' => 'function(slider){$("body").removeClass("loading");}',
    ),
	
	'htmlOptions'=>array(
		'id'=>'slider2',
		//'style'=>'width:630px;height:100px;',
	),
));

	Yii::import('shop.models.*');
	$tabs=array();
	$tabItems=array();
	$products = $flex_datasource->getData();
	foreach($products as $product){
		//echo Yii::trace(CVarDumper::dumpAsString($product->images),'vardump');
		$images=$product->images;
		$tabItems[]=array(
						
					);
	}
	$this->widget('application.components.widgets.TabList',array(
		'tabs'=>array(
			'tabList1'=>array(
				'id'=>'tabList1',
				'title'=>'Top Ten Product',
				'listItems'=>array(
					'item1'=>array(
						'link'=>Yii::app()->request->baseUrl.'/xxxxx',
						'desc'=>'xxxxx',
					),
					'item2'=>array(
						'link'=>Yii::app()->request->baseUrl.'/yyyyy',
						'desc'=>'yyyyy',
					),
				),
			),
			'tabList2'=>array(
				'id'=>'tabList2',
				'title'=>'Top Ten Store',
				'listItems'=>array(
					'item1'=>array(
						'link'=>Yii::app()->request->baseUrl.'/xxwwwwwxxx',
						'desc'=>'wwwww',
					),
					'item2'=>array(
						'link'=>Yii::app()->request->baseUrl.'/yyzzzzyyy',
						'desc'=>'yzzzzyyyy',
					),
				),
			),
		)
	)
	);
?>
	</div>
</section>
<!-- Banner Section -->

<!-- Content Section -->
<section class="content-wrapper">
	<div class="content-container container">
	
	<div class="heading-block">
	<h1>Featured Shoes</h1>
	<ul class="pagination">
		<li class="grid"><a href="#" title="Grid">Grid</a></li>
	</ul>
	</div>
	<div class="feature-block">
		<?php
			$featureProducts = array();
			for ($i=0;$i<9;$i++){
				$featureProducts[] = array(
					'name'=>'Adidas mutombo',
					'imgLink'=>'productimages/250_'.$i.'.jpg',
					'quickViewLink'=>'',
					'detailViewLink'=>'',
					'price'=>'333.00',
				);
			}
			$this->widget('application.components.widgets.FeatureProductGrid', array('id'=>'mix','products'=>$featureProducts));
		?>
	</div>
	
	<div class="heading-block">
	<ul class="pagination">
		<li class="grid"><a href="#" title="Grid">Grid</a></li>
	</ul>
	</div>
	<div class="feature-block">
		<?php
			$featureProducts = array();
			for ($i=0;$i<9;$i++){
				$featureProducts[] = array(
					'name'=>'Adidas mutombo',
					'imgLink'=>'productimages/250_'.$i.'.jpg',
					'quickViewLink'=>'',
					'detailViewLink'=>'',
					'price'=>'222.00',
				);
			}
			$this->widget('application.components.widgets.FeatureProductGrid', array('id'=>'mix2','products'=>$featureProducts));
		?>
	</div>

				
				
                <div class="heading-block">
                  <h1>New Shoes</h1>
                </div>
                <div class="new-product-block">
				
				
				<?php
			$newProducts = array();
			for ($i=0;$i<9;$i++){
				$newProducts[] = array(
					'name'=>'Adidas mutombo',
					'imgLink'=>'productimages/250_'.$i.'.jpg',
					'quickViewLink'=>'',
					'detailViewLink'=>'',
					'cartLink'=>'',
					'wishlistLink'=>'',
					'price'=>'222.00',
				);
			}
			$this->widget('application.components.widgets.ProductGrid', array('products'=>$newProducts));
		?>
				
				
                  <ul class="product-grid">
				   
                      <?php 
				  for ($i=0;$i<4;$i++){ ?>
                    <li>
                      <div class="pro-img">
                        <a href="?page=viewproduct"><img title="Freature Product" alt="Freature Product" src="productimages/250_<?php echo $i;?>.jpg" /></a>
                      </div>
                      <div class="pro-content">
                        <p>White Round Neck T-Shirt</p>
                      </div>
                      <div class="pro-price">$600.00</div>
                      <div class="pro-btn-block"> 
                      <a class="add-cart left" href="#" title="Add to Cart">Add to Cart</a> 
                      <a class="add-cart right quickCart inline" href="#quick-view-container" title="Quick View">Quick View</a> </div>
                      <div class="pro-link-block"> <a class="add-wishlist left" href="#" title="Add to wishlist">Add to wishlist</a> 
                        <div class="clearfix"></div>
                      </div>
                    </li>
                     
                    <?php } ?>
                    
                  </ul>
                  <ul class="product-grid">
                    <?php 
				  for ($i=0;$i<4;$i++){ ?>
                    <li>
                      <div class="pro-img">
                        <a href="?page=viewproduct"><img title="Freature Product" alt="Freature Product" src="productimages/250_<?php echo $i;?>.jpg" /></a>
                      </div>
                      <div class="pro-content">
                        <p>White Round Neck T-Shirt</p>
                      </div>
                      <div class="pro-price">$600.00</div>
                      <div class="pro-btn-block"> 
                      <a class="add-cart left" href="#" title="Add to Cart">Add to Cart</a> 
                      <a class="add-cart right quickCart inline" href="#quick-view-container" title="Quick View">Quick View</a> </div>
                      <div class="pro-link-block"> <a class="add-wishlist left" href="#" title="Add to wishlist">Add to wishlist</a> 
                        <div class="clearfix"></div>
                      </div>
                    </li>
                     
                    <?php } ?>
                  </ul>
				   <ul class="product-grid">
                   <?php 
				  for ($i=0;$i<4;$i++){ ?>
                    <li>
                      <div class="pro-img">
                        <a href="?page=viewproduct"><img title="Freature Product" alt="Freature Product" src="productimages/250_<?php echo $i;?>.jpg" /></a>
                      </div>
                      <div class="pro-content">
                        <p>White Round Neck T-Shirt</p>
                      </div>
                      <div class="pro-price">$600.00</div>
                      <div class="pro-btn-block"> 
                      <a class="add-cart left" href="#" title="Add to Cart">Add to Cart</a> 
                      <a class="add-cart right quickCart inline" href="#quick-view-container" title="Quick View">Quick View</a> </div>
                      <div class="pro-link-block"> <a class="add-wishlist left" href="#" title="Add to wishlist">Add to wishlist</a> 
                        <div class="clearfix"></div>
                      </div>
                    </li>
                     
                    <?php } ?>
                  </ul>
				   <ul class="product-grid">
                     <?php 
				  for ($i=0;$i<4;$i++){ ?>
                    <li>
                      <div class="pro-img">
                        <a href="?page=viewproduct"><img title="Freature Product" alt="Freature Product" src="productimages/default_img.png" /></a>
                      </div>
                      <div class="pro-content">
                        <p>White Round Neck T-Shirt</p>
                      </div>
                      <div class="pro-price">$600.00</div>
                      <div class="pro-btn-block"> 
                      <a class="add-cart left" href="#" title="Add to Cart">Add to Cart</a> 
                      <a class="add-cart right quickCart inline" href="#quick-view-container" title="Quick View">Quick View</a> </div>
                      <div class="pro-link-block"> <a class="add-wishlist left" href="#" title="Add to wishlist">Add to wishlist</a> 
                        <div class="clearfix"></div>
                      </div>
                    </li>
                     
                    <?php } ?>
                  </ul>
				   <ul class="product-grid">
                    <?php 
				  for ($i=0;$i<4;$i++){ ?>
                    <li>
                      <div class="pro-img">
                        <a href="?page=viewproduct"><img title="Freature Product" alt="Freature Product" src="productimages/default_img.png" /></a>
                      </div>
                      <div class="pro-content">
                        <p>White Round Neck T-Shirt</p>
                      </div>
                      <div class="pro-price">$600.00</div>
                      <div class="pro-btn-block"> 
                      <a class="add-cart left" href="#" title="Add to Cart">Add to Cart</a> 
                      <a class="add-cart right quickCart inline" href="#quick-view-container" title="Quick View">Quick View</a> </div>
                      <div class="pro-link-block"> <a class="add-wishlist left" href="#" title="Add to wishlist">Add to wishlist</a> 
                        <div class="clearfix"></div>
                      </div>
                    </li>
                     
                    <?php } ?>
                  </ul>
                </div>
	
	
	
	
	
	
	</div>
</section>
<!-- Content Section -->