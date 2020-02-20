<?php

class Lifestyles extends CActiveRecord
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
		return Shop::module()->lifestylesTable;
	}

	public function beforeValidate() {
		 
		$parser=new CMarkdownParser;
		$this->descriptionDisplay = str_replace('<br /><br />', '', str_replace("\n",'<br />', $parser->safeTransform($this->description)));
		
		return parent::beforeValidate();
	}
	
 
	public function rules()
	{
		return array(
			
			array('title', 'required'),
			 
			array('id, user_id,owner_pet_id', 'numerical', 'integerOnly'=>true),
			  array('email, title,table_name', 'length', 'max'=>255),
			array('id,user_id,owner_pet_id', 'length', 'max'=>10),
			array('user_id,email,id,title,description,owner_pet_id', 'safe'),
			array('id,user_id,email,title,owner_pet_id', 'safe', 'on'=>'search')
		);
	}

	public function relations()
	{
		return array(
			 
			'images' => array(self::HAS_MANY, 'AppImage', 'product_id',
			'condition'=>'images.app_table=\'LIFESTYLE\''),
			 
		);
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
 

	public function attributeLabels()
	{
		$labels = array(
				'id' => Yii::t('shop','LifeStylesid'),
				'user_id' => Yii::t('shop','user_id'),
				'email ' => 'email',
				'title' => Yii::t('shop','LifeStyles_title'),
				'description' => Yii::t('shop','LifeStyles description'),
				'created_date' => Yii::t('shop',' '),
				'modified_date' => 'Discount (%)',
			 
				 
				);
	 

		return $labels;
	}

	 

	 
 
	 
	
	public function search()
	{

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		 
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		 
		$criteria->order='created DESC';

		return new CActiveDataProvider('Lifestyles', array(
			'criteria'=>$criteria,
		));
	}

	
	 
	
	  
	
	public function searchNew()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('status',1);
		$criteria->limit=Shop::module()->noOfNewShoes;
		$criteria->order='created DESC';

		return new CActiveDataProvider('Lifestyles', array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => Shop::module()->noOfNewShoes,),
		));
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
	
	public function getVariations() {
		$variations = array();
		foreach($this->variations as $variation) {
			$variations[$variation->specification_id][] = $variation;
		}		

		return $variations;
	}

	public function getRegularPrice($variations = null, $amount = 1) {
		if($this->price === null)
			$price = (float) Shop::module()->defaultPrice;
		else
			$price = (float) $this->price;

 
		 

		return (float) $price *= $amount;
	}
}
