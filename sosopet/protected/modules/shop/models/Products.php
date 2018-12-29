<?php

class Products extends CActiveRecord
{
	// If at least one product variation has the type 'image', the user needs
	// to upload a image file in order to buy the product. To achieve this,
	// we need to set the 'enctype' to 'multipart/form-data'. This function
	// checks, if the product has a 'image' variation.
	public function hasUpload() {
		foreach($this->variations as $variation)
			if($variation->specification->input_type == 'image')
				return true;

		return false;

	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return Shop::module()->productsTable;
	}

	public function beforeValidate() {
		if(Yii::app()->language == 'de')
			$this->price = str_replace(',', '.', $this->price);

		$parser=new CMarkdownParser;
		$this->descriptionDisplay = str_replace('<br /><br />', '', str_replace("\n",'<br />', $parser->safeTransform($this->description)));
		
		return parent::beforeValidate();
	}
	
	public function beforeDelete() {
		//check if this product was ordered or got feedback
		$count = OrderPosition::Model()->count("product_id=:product_id", array("product_id" => $this->product_id));
		if($count>0){
			//$this->addError('product_id', 'This product was ordered before.  Please try to set the product to inactive.');
			return false;
		}
	
		//delete corresponding images
		Image::model()->deleteAllByAttributes(array(
			'product_id'=>$this->product_id,
		));
		
		//delete corresponding variations
		ProductVariation::model()->deleteAllByAttributes(array(
			'product_id'=>$this->product_id,
		));
		
		//delete corresponding wishlist
		Wishlist::model()->deleteAllByAttributes(array(
			'product_id'=>$this->product_id,
		));
		
		return parent::beforeDelete();
	}

	public function rules()
	{
		return array(
			//array('title, category_id, status, tax_id, quantity, price, size, condition', 'required'),
			//array('title, category_id,country_id, status, tax_id, price, condition, sub_category', 'required'),
			array('title', 'required'),
			array('price, discount', 'type', 'type'=>'float'),
			array('product_id, category_id, country_id,status, store_id, quantity, view', 'numerical', 'integerOnly'=>true),
			array('title, price, language, discount', 'length', 'max'=>45),
			array('keywords, questions', 'length', 'max'=>255),
			array('last_seen_appearance', 'length', 'max'=>100),
			array('pet_id', 'length', 'max'=>20),
			array('gender', 'length', 'max'=>3),
			//array('title', 'unique'),
			//array('store_id, description, specifications, style_code, color', 'safe'),
			array('store_id, description, specifications, style_code, color, size, quantity, discount, banner_a, banner_b, banner_c, todays_deal, date_lost, date_born, weight, height, name_of_pet, country, contact, pet_status, count_down_end_date, last_seen_appearance, questions, pet_id, gender,country_id,sub_country_id', 'safe'),
			array('product_id, store_id, title, description, price, category_id, keywords, discount, date_lost, date_born, sub_category, weight, height, name_of_pet, country, contact, pet_status, pet_id, gender,country_id,sub_country_id', 'safe', 'on'=>'search'),
			array('created','default',
              'value'=>new CDbExpression('NOW()'),
              'setOnEmpty'=>false,'on'=>'insert')
		);
	}

	public function relations()
	{
		return array(
			'variations' => array(self::HAS_MANY, 'ProductVariation', 'product_id', 'order' => 'position'),
			'variationCount' => array(self::STAT, 'ProductVariation', 'product_id'),
			'orders' => array(self::MANY_MANY, 'Order', 'ShopProductOrder(order_id, product_id)'),
			
			 'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
			 'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
			 'sub_country' => array(self::BELONGS_TO, 'Country', 'sub_country_id'),
			'tax' => array(self::BELONGS_TO, 'Tax', 'tax_id'),
			'images' => array(self::HAS_MANY, 'Image', 'product_id'),
			'shopping_carts' => array(self::HAS_MANY, 'ShoppingCart', 'product_id'),
			'wishlists'=>array(self::HAS_MANY, 'Wishlist', 'product_id'),
			'favourites'=>array(self::HAS_MANY, 'Wishlist', 'product_id'),
			'store' =>array(self::BELONGS_TO, 'Store', 'store_id'),
		);
	}

	public function afterSave( ) {
		$this->addImages( );
		parent::afterSave( );
	}
	
	public function addImages( ) {
		//If we have pending images
		if( Yii::app( )->user->hasState( 'images' ) ) {
			$userImages = Yii::app( )->user->getState( 'images' );
			//Resolve the final path for our images
			$path = Yii::app( )->getBasePath( )."/../".Shop::module()->productImagesFolder."{$this->product_id}/";
			$thumbPath = Yii::app( )->getBasePath( )."/../".Shop::module()->productThumbImagesFolder."{$this->product_id}/";
			//Create the folder and give permissions if it doesnt exists
			if( !is_dir( $path ) ) {
				mkdir( $path );
				chmod( $path, 0777 );
			}
			if( !is_dir( $thumbPath ) ) {
				mkdir( $thumbPath );
				chmod( $thumbPath, 0777 );
			}
			chmod( $thumbPath, 0777 );
			//Now lets create the corresponding models and move the files
			foreach( $userImages as $image ) {
				if( is_file( $image["path"] ) && is_file($image["thumb"])) {
					if( rename( $image["path"], $path.$image["filename"] ) && rename( $image["thumb"], $thumbPath.$image["filename"] )) {
					//if( rename( $image["path"], $path.$image["filename"] ) ) {
						chmod( $path.$image["filename"], 0777 );
						chmod( $thumbPath.$image["filename"], 0777 );
						$img = new Image();
						$img->title = $image["name"];
						$img->filename = "{$this->product_id}/".$image["filename"];
						$img->product_id = $this->product_id;
						if( !$img->save( ) ) {
							//Its always good to log something
							//Yii::log( "Could not save Image:\n".CVarDumper::dumpAsString( 
							//	$img->getErrors( ) ), CLogger::LEVEL_ERROR );
							//this exception will rollback the transaction
							throw new Exception( 'Could not save Image'.CHtml::errorSummary($img));
						}
						/*
						$img = new Image( );
						$img->size = $image["size"];
						$img->mime = $image["mime"];
						$img->name = $image["name"];
						$img->source = "/".Shop::module()->productImagesFolder."{$this->product_id}/".$image["filename"];
						$img->product_id = $this->product_id;
						if( !$img->save( ) ) {
							//Its always good to log something
							Yii::log( "Could not save Image:\n".CVarDumper::dumpAsString( 
								$img->getErrors( ) ), CLogger::LEVEL_ERROR );
							//this exception will rollback the transaction
							throw new Exception( 'Could not save Image');
						}
						*/
					}
				} else {
					//You can also throw an execption here to rollback the transaction
					Yii::log( $image["path"]." is not a file", CLogger::LEVEL_WARNING );
				}
			}
			//Clear the user's session
			Yii::app( )->user->setState( 'images', null );
		}
	}
	
	public function getSpecification($spec) {
		$specs = json_decode($this->specifications, true);

		if(isset($specs[$spec]))
			return $specs[$spec];

		return false;
	}

	public function getImage($image = 0, $thumb = false) {
		$tmp_img = 0;
		if(isset($this->images)){
			foreach($this->images as $img) {
				if($img->is_default=='Y')
					$image = $tmp_img;
				$tmp_img = $tmp_img + 1;
			}
		}
		
		if(isset($this->images[$image]))
			return Yii::app()->controller->renderPartial('/image/view', array(
				'model' => $this->images[$image],
				'thumb' => $thumb), true); 
	}
	
	public function getCartImage($image = 0, $thumb = false) {
		$tmp_img = 0;
		if(isset($this->images)){
			foreach($this->images as $img) {
				if($img->is_default=='Y')
					$image = $tmp_img;
				$tmp_img = $tmp_img + 1;
			}
		}
		
		if(isset($this->images[$image]))
			return Yii::app()->controller->renderPartial('/image/_cart_view', array(
				'model' => $this->images[$image],
				'thumb' => $thumb), true); 
	}

	public function getSpecifications() {
		$specs = json_decode($this->specifications, true);
		return $specs === null ? array() : $specs;
	}

	public function renderSpecifications() {
		echo $this->getSpecifications();
	}

	public function setSpecification($spec, $value) {
		$specs = json_decode($this->specifications, true);

		$specs[$spec] = $value;

		return $this->specifications = json_encode($specs);
	}

	public function setSpecifications($specs) {
		foreach($specs as $k => $v)
			$this->setSpecification($k, $v);
	}

	public function setVariations($variations) {
		$db = Yii::app()->db;
		$db->createCommand()->delete('shop_product_variation',
				'product_id = :product_id', array(
					':product_id' => $this->product_id));

		foreach($variations as $key => $value) {
			if($value['specification_id'] 
					&& isset($value['title']) 
					&& $value['title'] != '') {
				/*
				$value['price_adjustion'] = strtr(
						$value['price_adjustion'], array(',' => '.'));

				if(isset($value['sign_price']) && $value['sign_price'] == '-')
					$value['price_adjustion'] -= 2 * $value['price_adjustion'];

				$value['weight_adjustion'] = strtr(
						$value['weight_adjustion'], array(',' => '.'));

				if(isset($value['sign_weight']) && $value['sign_weight'] == '-')
					$value['weight_adjustion'] -= 2 * $value['weight_adjustion'];
				*/
				$db->createCommand()->insert('shop_product_variation', array(
							'product_id' => $this->product_id,
							'specification_id' => $value['specification_id'],
							'position' => @$value['position'] ? $value['position'] : 0,
							'title' => $value['title'],
							'price_adjustion' => @$value['price_adjustion'] ? $value['price_adjustion'] : 0,
							'weight_adjustion' => @$value['weight_adjustion'] ? $value['weight_adjustion'] : 0,
							'quantity'=>@$value['quantity'] ? $value['quantity'] : 0,
							));	
			}
		} 
	} 

		public function getVariations() {
		$variations = array();
		foreach($this->variations as $variation) {
			$variations[$variation->specification_id][] = $variation;
		}		

		return $variations;
	}


	public function attributeLabels()
	{
		$labels = array(
				'tax_id' => Yii::t('shop','Tax'),
				'product_id' => Yii::t('shop','Product'),
				'store_id' => 'Store ID',
				'title' => Yii::t('shop','WHOSPETS Name - What would you like your like to be called on WHOSPETS'),
				'description' => Yii::t('shop','Profile - Write some detail about your pet, e.g. health condition, character and whatever you want!'),
				'price' => Yii::t('shop','Reward - If you would like to give some reward to the finder, please put the amount in here. If you do not wish to include a reward please input 0.'),
				'discount' => 'Discount (%)',
				//'category_id' => Shop::t('Category'),
				'category_id' => Yii::t('shop','Pet Breed'),
				'style_code' => 'Style Code',
				'color' => Yii::t('shop','Pet Color'),
				'condition' =>  Yii::t('shop','Pet Condition - If your pet is alive please choose "Active", otherwise please choose "Inactive".'),
				'size' => Yii::t('shop','Pet Size'),
				'banner_a' => 'Banner A',
				'banner_b' => 'Banner B',
				'banner_c' => 'Banner C',
				'todays_deal' => 'Today\'s Deal',
				'date_lost' => Yii::t('shop','Date Lost - Please leave this blank otherwise'),
				'date_born' => Yii::t('shop','Date Born - Please input the birth date of your pet'),
				'sub_category' =>  Yii::t('shop','Type of Pet'),
				'weight' => Yii::t('shop','Pet Weight'),
				'height' => Yii::t('shop','Pet Height'),
				'name_of_pet' => Yii::t('shop','Pet Name'),
				'country' => Yii::t('shop','Country - Which Country is your pet living in right now?'),
				'contact' => Yii::t('shop','Your mobile number - You can include your mobile number here for the ease of contact. Otherwise, please leave it blank!'),
				'pet_status' => Yii::t('shop','Pet Status - Is you pet lost? At home? Or has been found and therefore at home! Phew...'),
				'count_down_end_date' => Yii::t('shop','Date Found - If your pet has recently been found and now safe at home, please input the found date here.'),
				'last_seen_appearance' => Yii::t('shop','Last Seen Appearance - When and where your pet was last seen before going missing? Include as many details as possible to help others to find your pet.'),
				'questions' => 'Product Questions',
				'pet_id' => Yii::t('shop','Pet ID - Please input the ID appeared on your tag'),
				'gender' => Yii::t('shop','Gender'),
				'status' => Yii::t('shop','Pet Condition - If your pet is alive please choose "Active", otherwise please choose "Inactive".'),
				);
		if(Shop::module()->useWithYum && Yii::app()->user->isAdmin())
			$labels['price'] = Shop::t('Price (net)');

		return $labels;
	}

	public function getWeightTaxRate($variations = null, $amount = 1) { 
		if($this->tax) {
			$taxrate = $this->tax->percent;	

			$price = $this->price;

			if($variations)
				foreach($variations as $key => $variation) 
					if($obj = ProductVariation::model()->findByPk($variation))
						$price += $obj->price_adjustion;

			$tax = $price * ($this->tax->percent / 100);

			$tax *= $amount;
			return $tax;
		}
	}

	public function getTaxRate($variations = null, $amount = 1) { 
		if($this->tax) {
			$taxrate = $this->tax->percent;	

			$price = $this->price;

			if($variations)
				foreach($variations as $key => $variation) 
					if($obj = ProductVariation::model()->findByPk($variation))
						$price += $obj->price_adjustion;

			$tax = $price * ($this->tax->percent / 100);

			$tax *= $amount;
			return $tax;
		}
	}

	public function getWeight($variations = null, $amount = 1) {
		$spec = ProductSpecification::model()->findByPk(
				Shop::module()->weightSpecificationId);

		$weight = 0;
		if($spec) {
			$specs = json_decode($this->specifications, true);
			if(isset($specs[$spec->title]))
				$weight += $specs[$spec->title];
		}


		if($variations)
			foreach($variations as $key => $variation) {
				if(is_array($variation))
					$variation = $variation[0];
				if(is_numeric($variation))
					$weight += @ProductVariation::model()->findByPk($variation)->getWeightAdjustion();
			}

		return (float) $weight *= $amount;
	}

	public function getPrice($variations = null, $amount = 1) {
		$price = $this->getDiscountPrice($variations, $amount);
		if ($price) {
			return $price;
		}else{
			return $this->getRegularPrice($variations, $amount);
		}
	}
	
	public function getRegularPrice($variations = null, $amount = 1) {
		if($this->price === null)
			$price = (float) Shop::module()->defaultPrice;
		else
			$price = (float) $this->price;

		if($this->tax)
			$price *= ($this->tax->percent / 100) + 1;

		if($variations)
			foreach($variations as $key => $variation) {
				if(is_numeric($variation))
					$price += @ProductVariation::model()->findByPk($variation)->getPriceAdjustion();
			}

		return (float) $price *= $amount;
	}
	
	public function getDiscount($unit = false) {
		if($unit){
			return $this->discount?$this->discount.'%':$this->discount;
		}else{
			return $this->discount;
		}
	}
	
	public function getDiscountOff($unit = false) {
		if($unit){
			return $this->discount?(100-$this->discount).'%':$this->discount;
		}else{
			return 100-$this->discount;
		}
	}
	
	public function getDiscountPrice($variations = null, $amount = 1) {
		$price = $this->getRegularPrice($variations);
		if($this->discount) {
			//$price = round($price*$this->discount/100, Shop::module()->discountPrecision);
			$price = ceil($price*$this->discount/100);
			return (float) $price *= $amount;
		}
		return null;
	}

	public function updateStock() {
		
	}
	
	public function search()
	{

		$criteria=new CDbCriteria;

		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('store_id',$this->store_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('category_id',$this->category_id);
		$criteria->order='created DESC';

		return new CActiveDataProvider('Products', array(
			'criteria'=>$criteria,
		));
	}

	
	public function searchRandom()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('status',1);
		//$criteria->addCondition('feature_date>NOW()','AND');
		$criteria->order='rand()';

		return new CActiveDataProvider('Products', array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 4,),
		));
	}
	
	public function searchFeature()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('status',1);
		$criteria->addCondition('created>=DATE_SUB(NOW(), INTERVAL 1 MONTH)','AND');
		$criteria->order='created DESC';
		//$criteria->order='rand()';
		//$criteria->limit=Shop::module()->noOfFeatureShoes;

		return new CActiveDataProvider('Products', array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 10,),
		));
	}
	
	public function searchGallery()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('status',1);
		$criteria->addCondition('gallery_date>NOW()','AND');
		$criteria->order='rand()';
		//$criteria->limit=Shop::module()->noOfFeatureShoes;

		return new CActiveDataProvider('Products', array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 50,),
		));
	}
	
	public function searchNew()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('status',1);
		$criteria->limit=Shop::module()->noOfNewShoes;
		$criteria->order='created DESC';

		return new CActiveDataProvider('Products', array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => Shop::module()->noOfNewShoes,),
		));
	}
	
	public function searchTop10()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('status',1);
		//$criteria->limit=5;
		$criteria->order='view DESC';

		return new CActiveDataProvider('Products', array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 10,),
		));
	}
	
	public function searchTodaysDeal()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('status',1);
		$criteria->compare('todays_deal','y');
		$criteria->order='rand()';

		return new CActiveDataProvider('Products', array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 10,),
		));
	}
	
	public function searchRecentLost()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('pet_status',1);
		$criteria->order='date_lost DESC';

		return new CActiveDataProvider('Products', array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 10,),
		));
	}
	
	public function searchHighestReward()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('pet_status',1);
		$criteria->order='price DESC';

		return new CActiveDataProvider('Products', array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 10,),
		));
	}
	
	public function searchYoungest()
	{
		$criteria=new CDbCriteria;
		$criteria->order='date_born DESC';

		return new CActiveDataProvider('Products', array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 10,),
		));
	}
	
	public function searchMostPopular()
	{
		$criteria=new CDbCriteria;
		$criteria->order='view DESC';

		return new CActiveDataProvider('Products', array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 10,),
		));
	}
 	public function searchPetForAdoption(){
	  $criteria=new CDbCriteria;
                $criteria->compare('pet_status',3);
		$criteria->order='rand()';

                return new CActiveDataProvider('Products', array(
                        'criteria'=>$criteria,
                        'pagination' => array('pageSize' => 10,),
                ));	
	
	
	}	
	public function searchRecentFound()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('pet_status',2);
		$criteria->order='count_down_end_date DESC';
		//$criteria->order='rand()';

		return new CActiveDataProvider('Products', array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 10,),
		));
	}
	
	public function updateFeatureDate($day) {
		//echo Yii::trace(CVarDumper::dumpAsString(strtotime($this->feature_date)),'vardump');
		//echo Yii::trace(CVarDumper::dumpAsString(strtotime('0000-00-00 00:00:00')),'vardump');
		//$fp = fopen('images/ipn.log','a');
		//fwrite($fp, 'update1' . "\n\n");
		//fclose($fp);
		if(strtotime($this->feature_date)!==strtotime('0000-00-00 00:00:00')){
			
			// has date
			$mydate = new DateTime();
			//echo Yii::trace(CVarDumper::dumpAsString($mydate),'vardump');
			//echo Yii::trace(CVarDumper::dumpAsString($mydate->date),'vardump');
			if($this->feature_date>=$mydate->format('Y-m-d H:i:s')){
				//$fp = fopen('images/ipn.log','a');
				//fwrite($fp, 'add' . "\n\n");
				//fclose($fp);
				$mydate = new DateTime($this->feature_date);
				//$fp = fopen('images/ipn.log','a');
				//fwrite($fp, 'add2' . "\n\n");
				//fclose($fp);
				//echo Yii::trace(CVarDumper::dumpAsString($mydate),'vardump');
				$mydate->modify('+'.$day.' days');
				$this->feature_date=$mydate->format('Y-m-d H:i:s');
			}else{
				//$fp = fopen('images/ipn.log','a');
				//fwrite($fp, 'add3' . "\n\n");
				//fclose($fp);
				//echo Yii::trace(CVarDumper::dumpAsString($mydate),'vardump');
				$mydate->modify('+'.$day.' days');
				//echo Yii::trace(CVarDumper::dumpAsString($mydate),'vardump');
				$this->feature_date=$mydate->format('Y-m-d H:i:s');
				//$fp = fopen('images/ipn.log','a');
				//fwrite($fp, $mydate->format('Y-m-d H:i:s') . "\n\n");
				//fwrite($fp, $this->feature_date . "\n\n");
				//fclose($fp);
			}
		}else{
			// empty
			//$fp = fopen('images/ipn.log','a');
			//	fwrite($fp, 'add4' . "\n\n");
			//	fclose($fp);
			$mydate = new DateTime();
			$mydate->modify('+'.$day.' days');
			$this->feature_date=$mydate->format('Y-m-d H:i:s');
		}
		
		$this->save();
	}
	
	public function updateGalleryDate($day) {
		//echo Yii::trace(CVarDumper::dumpAsString(strtotime($this->gallery_date)),'vardump');
		//echo Yii::trace(CVarDumper::dumpAsString(strtotime('0000-00-00 00:00:00')),'vardump');
		//$fp = fopen('images/ipn.log','a');
		//fwrite($fp, 'update1' . "\n\n");
		//fclose($fp);
		if(strtotime($this->gallery_date)!==strtotime('0000-00-00 00:00:00')){
			
			// has date
			$mydate = new DateTime();
			//echo Yii::trace(CVarDumper::dumpAsString($mydate),'vardump');
			//echo Yii::trace(CVarDumper::dumpAsString($mydate->date),'vardump');
			if($this->gallery_date>=$mydate->format('Y-m-d H:i:s')){
				//$fp = fopen('images/ipn.log','a');
				//fwrite($fp, 'add' . "\n\n");
				//fclose($fp);
				$mydate = new DateTime($this->gallery_date);
				//$fp = fopen('images/ipn.log','a');
				//fwrite($fp, 'add2' . "\n\n");
				//fclose($fp);
				//echo Yii::trace(CVarDumper::dumpAsString($mydate),'vardump');
				$mydate->modify('+'.$day.' days');
				$this->gallery_date=$mydate->format('Y-m-d H:i:s');
			}else{
				//$fp = fopen('images/ipn.log','a');
				//fwrite($fp, 'add3' . "\n\n");
				//fclose($fp);
				//echo Yii::trace(CVarDumper::dumpAsString($mydate),'vardump');
				$mydate->modify('+'.$day.' days');
				//echo Yii::trace(CVarDumper::dumpAsString($mydate),'vardump');
				$this->gallery_date=$mydate->format('Y-m-d H:i:s');
				//$fp = fopen('images/ipn.log','a');
				//fwrite($fp, $mydate->format('Y-m-d H:i:s') . "\n\n");
				//fwrite($fp, $this->gallery_date . "\n\n");
				//fclose($fp);
			}
		}else{
			// empty
			//$fp = fopen('images/ipn.log','a');
			//	fwrite($fp, 'add4' . "\n\n");
			//	fclose($fp);
			$mydate = new DateTime();
			$mydate->modify('+'.$day.' days');
			$this->gallery_date=$mydate->format('Y-m-d H:i:s');
		}
		
		$this->save();
	}
	
	public function getDefaultImage(){
		return Image::model()->findByAttributes(array('product_id'=>$this->product_id,'is_default'=>'Y'));
	}
	
	public function getDetailCategory(){
		$cat = $this->category;
	  
		if (Yii::app()->language!='en'){
			$tempCatTitle = $cat->{'title_'.Yii::app()->language};
		}
		else
			$tempCatTitle = $cat->title;
		  
	 	while ($cat->parent_id != 0) {
			$cat = Category::model()->findByPk($cat->parent_id);
			//$tempCatTitle = $cat->title.' > '.$tempCatTitle;
			if (Yii::app()->language!='en'){
			$tempCatTitle = $cat->{'title_'.Yii::app()->language};
			}
			else
				$tempCatTitle = $cat->title;

		}
	 
		return $tempCatTitle;
	}
	public function getParentCountryTitle(){
		$cat = $this->sub_country;
		
		if (Yii::app()->language!='en'){
			$tempCatTitle = $cat->{'title_'.Yii::app()->language};
		}
		else
			$tempCatTitle = $cat->title;
		  
		   
		while ($cat->parent_id != 0) {
			$cat = Country::model()->findByPk($cat->parent_id);
			 
			if (Yii::app()->language!='en'){
			$tempCatTitle = $cat->{'title_'.Yii::app()->language};
			}
			else
				$tempCatTitle = $cat->title;
		}
		return $tempCatTitle;
	}
}
