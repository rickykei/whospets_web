<div class="page_wrapper">

	<div class="container">

		<!-- - - - - - - - - - - - - - Banners - - - - - - - - - - - - - - - - -->
		<?php
		$banners= array(
					array('image'=>Yii::app()->request->baseUrl.'/images/banner_img_7.jpg',
						'href'=>'https://www.vetopia.com.hk','target'=>'_blank',
					),
					array('image'=>Yii::app()->request->baseUrl.'/images/banner_img_8.jpg',
						'href'=>'http://www.brit-petfood.com','target'=>'_blank',
					),
					array('image'=>Yii::app()->request->baseUrl.'/images/banner_img_9.jpg',
						'href'=>'http://www.apepet.hk','target'=>'_blank',
					),
				);
		$this->widget('application.components.widgets.BannerWidget',array(
					'items'=>$banners
				)
			);
		?>

		<!-- - - - - - - - - - - - - - End of banners - - - - - - - - - - - - - - - - -->

		<!-- - - - - - - - - - - - - - Today's deals - - - - - - - - - - - - - - - - -->
		<?php
		$image_folder = Shop::module()->productImagesFolder;
		$thumb_image_folder = Shop::module()->productThumbImagesFolder;
		
		// Recent Lost
		$recentLostProductArray=array();
		foreach($recentLostProducts as $product){
			$default_image=$product->getDefaultImage();
			$images=$product->images;
			if($default_image){
				$image_link=Yii::app()->baseUrl.'/'.$thumb_image_folder.'/'.$default_image->filename;
			}else{
				if($images)
					$image_link=Yii::app()->baseUrl.'/'.$thumb_image_folder.'/'.current($images)->filename;
				else
					$image_link=Shop::register('no-pic.jpg');
			}
			$product_link=Yii::app()->createUrl("/shop/products/view",array("id" => $product->product_id));
			$discount=$product->getDiscountOff(true);
			$recentLostProductArray[]=array(
							'image'=>$image_link,
							'href'=>$product_link,
							'description'=>$product->title,
							'label'=>$discount?array('type'=>'discount','value'=>$discount,):null,
							'countdownEndDate'=>$product->date_lost,
						);
		}
		// Highest Reward
		$highestRewardProductArray=array();
		foreach($highestRewardProducts as $product){
			$default_image=$product->getDefaultImage();
			$images=$product->images;
			if($default_image){
				$image_link=Yii::app()->baseUrl.'/'.$thumb_image_folder.'/'.$default_image->filename;
			}else{
				if($images)
					$image_link=Yii::app()->baseUrl.'/'.$thumb_image_folder.'/'.current($images)->filename;
				else
					$image_link=Shop::register('no-pic.jpg');
			}
			$product_link=Yii::app()->createUrl("/shop/products/view",array("id" => $product->product_id));
			$discount=$product->getDiscountOff(true);
			$highestRewardProductArray[]=array(
							'image'=>$image_link,
							'href'=>$product_link,
							'description'=>$product->title,
							'price'=>$product->price,
							'label'=>$discount?array('type'=>'discount','value'=>$discount,):null,
							'countdownEndDate'=>$product->count_down_end_date,
						);
		}
		// Youngest
		$youngestProductArray=array();
		foreach($youngestProducts as $product){
			$default_image=$product->getDefaultImage();
			$images=$product->images;
			if($default_image){
				$image_link=Yii::app()->baseUrl.'/'.$thumb_image_folder.'/'.$default_image->filename;
			}else{
				if($images)
					$image_link=Yii::app()->baseUrl.'/'.$thumb_image_folder.'/'.current($images)->filename;
				else
					$image_link=Shop::register('no-pic.jpg');
			}
			$product_link=Yii::app()->createUrl("/shop/products/view",array("id" => $product->product_id));
			$discount=$product->getDiscountOff(true);
			$youngestProductArray[]=array(
							'image'=>$image_link,
							'href'=>$product_link,
							'description'=>$product->title,
							'label'=>$discount?array('type'=>'discount','value'=>$discount,):null,
							//'countdownEndDate'=>$product->count_down_end_date,
						);
		}
		// Most Popular
		$mostPopularProductArray=array();
		foreach($mostPopularProducts as $product){
			$default_image=$product->getDefaultImage();
			$images=$product->images;
			if($default_image){
				$image_link=Yii::app()->baseUrl.'/'.$thumb_image_folder.'/'.$default_image->filename;
			}else{
				if($images)
					$image_link=Yii::app()->baseUrl.'/'.$thumb_image_folder.'/'.current($images)->filename;
				else
					$image_link=Shop::register('no-pic.jpg');
			}
			$product_link=Yii::app()->createUrl("/shop/products/view",array("id" => $product->product_id));
			$discount=$product->getDiscountOff(true);
			$mostPopularProductArray[]=array(
							'image'=>$image_link,
							'href'=>$product_link,
							'description'=>$product->title,
							'label'=>$discount?array('type'=>'discount','value'=>$discount,):null,
							//'countdownEndDate'=>$product->count_down_end_date,
						);
		}
		// Recent Found
		$recentFoundProductArray=array();
		foreach($recentFoundProducts as $product){
			$default_image=$product->getDefaultImage();
			$images=$product->images;
			if($default_image){
				$image_link=Yii::app()->baseUrl.'/'.$thumb_image_folder.'/'.$default_image->filename;
			}else{
				if($images)
					$image_link=Yii::app()->baseUrl.'/'.$thumb_image_folder.'/'.current($images)->filename;
				else
					$image_link=Shop::register('no-pic.jpg');
			}
			$product_link=Yii::app()->createUrl("/shop/products/view",array("id" => $product->product_id));
			$discount=$product->getDiscountOff(true);
			$recentFoundProductArray[]=array(
							'image'=>$image_link,
							'href'=>$product_link,
							'description'=>$product->title,
							'label'=>$discount?array('type'=>'discount','value'=>$discount,):null,
							'countdownEndDate'=>$product->count_down_end_date,
							'price'=>$product->price,
						);
		}
		
		$this->widget('application.components.widgets.ProductShowcaseWidget',array(
					'title'=>array('description'=>Yii::t('shop','Recent Lost Pets'),'class'=>'section_title'),
					'noOfItems'=>6,
					'items'=>$recentLostProductArray,
				)
			);
		?>
		
		<!-- - - - - - - - - - - - - - End of today's deals - - - - - - - - - - - - - - - - -->

		<!-- - - - - - - - - - - - - - Highest Reward products - - - - - - - - - - - - - - - - -->

		<?php
/*Stephen
		//shuffle($featureProductArray);
		$this->widget('application.components.widgets.ProductShowcaseWidget',array(
					'title'=>array('description'=>'Highest Reward Pets','class'=>'section_title2'),
					'noOfItems'=>6,
					'items'=>$highestRewardProductArray,
				)
			);
*/
		?>
		<!-- - - - - - - - - - - - - - End of Highest Reward products - - - - - - - - - - - - - - - - -->
		<!-- - - - - - - - - - - - - - Youngest products - - - - - - - - - - - - - - - - -->

		<?php

/*Stephen
		//shuffle($featureProductArray);
		$this->widget('application.components.widgets.ProductShowcaseWidget',array(
					'title'=>array('description'=>'Youngest Pets','class'=>'section_title2'),
					'noOfItems'=>6,
					'items'=>$youngestProductArray,
				)
			);
*/
		?>
		<!-- - - - - - - - - - - - - - End of Youngest products - - - - - - - - - - - - - - - - -->
		<!-- - - - - - - - - - - - - - Most popular products - - - - - - - - - - - - - - - - -->

		<?php
		//shuffle($featureProductArray);
		$this->widget('application.components.widgets.ProductShowcaseWidget',array(
					'title'=>array('description'=>Yii::t('shop','Pet for adoption'),'class'=>'section_title2'),
					'noOfItems'=>6,
					'items'=>$mostPopularProductArray,
				)
			);
		?>
		<!-- - - - - - - - - - - - - - End of Most popular products - - - - - - - - - - - - - - - - -->
		<!-- - - - - - - - - - - - - - Recent Found products - - - - - - - - - - - - - - - - -->

		<?php
		//shuffle($featureProductArray);
		$this->widget('application.components.widgets.ProductShowcaseWidget',array(
					'title'=>array('description'=>Yii::t('shop','Recent Found Pets'),'class'=>'section_title2'),
					'noOfItems'=>4,
					'items'=>$recentFoundProductArray,
				)
			);
		?>
		<!-- - - - - - - - - - - - - - End of Recent Found products - - - - - - - - - - - - - - - - -->

		<!-- - - - - - - - - - - - - - Testimonials - - - - - - - - - - - - - - - - -->
		<!-- - - - - - - - - - - - - - End of testimonials - - - - - - - - - - - - - - - - -->
		<!-- - - - - - - - - - - - - - Bestsellers - - - - - - - - - - - - - - - - -->
		<?php
		/*
		$products= array(
					array('image'=>Yii::app()->request->baseUrl.'/images/product_img_18.jpg',
						'href'=>'',
						'description'=>'Tellus Dolor Dapibus Eget 24 fl oz',
						'label'=>array('type'=>'bestseller',),
						//'price'=>9.99,
						//'discountPrice'=>5.99,
						//'rating'=>4,
					),
					array('image'=>Yii::app()->request->baseUrl.'/images/product_img_19.jpg',
						'href'=>'',
						'description'=>'Tellus Dolor Dapibus Eget 12 fl oz',
						'label'=>array('type'=>'discount','value'=>'40%',),
						//'price'=>8.99,
						//'discountPrice'=>4.99,
						//'rating'=>3,
					),
					array('image'=>Yii::app()->request->baseUrl.'/images/product_img_20.jpg',
						'href'=>'',
						'description'=>'Tellus Dolor Dapibus Eget 88 fl oz',
						'label'=>array('type'=>'discount','value'=>'50%',),
						//'price'=>10.99,
						//'discountPrice'=>6.99,
						//'rating'=>5,
					),
					array('image'=>Yii::app()->request->baseUrl.'/images/product_img_21.jpg',
						'href'=>'',
						'label'=>array('type'=>'new',),
						//'price'=>1.99,
					),
					array('image'=>Yii::app()->request->baseUrl.'/images/product_img_22.jpg',
						'href'=>'',
						'label'=>array('type'=>'hot',),
						//'price'=>2.99,
					),
					array('image'=>Yii::app()->request->baseUrl.'/images/product_img_23.jpg',
						'href'=>'',
						//'price'=>3.99,
					),
					array('image'=>Yii::app()->request->baseUrl.'/images/product_img_18.jpg',
						'href'=>'',
					),
					array('image'=>Yii::app()->request->baseUrl.'/images/product_img_19.jpg',
						'href'=>'',
					),
					array('image'=>Yii::app()->request->baseUrl.'/images/product_img_20.jpg',
						'href'=>'',
					),
					array('image'=>Yii::app()->request->baseUrl.'/images/product_img_21.jpg',
						'href'=>'',
					),
					array('image'=>Yii::app()->request->baseUrl.'/images/product_img_22.jpg',
						'href'=>'',
					),
					array('image'=>Yii::app()->request->baseUrl.'/images/product_img_23.jpg',
						'href'=>'',
					),
				);*/
		/*$this->widget('application.components.widgets.ProductShowcaseWidget',array(
					'title'=>array('description'=>'Bestsellers',),
					'noOfItems'=>4,
					'items'=>$products,
				)
			);*/
		?>
		<!-- - - - - - - - - - - - - - End of bestsellers - - - - - - - - - - - - - - - - -->

		<!-- - - - - - - - - - - - - - Our brands - - - - - - - - - - - - - - - - -->
		<!-- - - - - - - - - - - - - - End our brands - - - - - - - - - - - - - - - - -->

		<!-- - - - - - - - - - - - - - Latest news - - - - - - - - - - - - - - - - -->
		<!-- - - - - - - - - - - - - - End of latest news - - - - - - - - - - - - - - - - -->
	</div><!--/ .container-->
</div><!--/ .page_wrapper-->
