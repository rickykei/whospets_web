<?php
class BannerProductsForm extends CFormModel
{
	public $id;
	//public $maxPrice;
	//public $category;
	//public $condition;
	//public $size;
	//public $store_id;
	//public $sorting;
	//public $keywords;
	
	//private $keywordSearchColumnArray = array('title', 'keywords', 'style_code'); //Columns to search 

    // Add a public property for each search form element here

	public function rules()
	{
		return array(
			// You should validate your search parameters here
			//array('category,store_id', 'numerical', 'integerOnly'=>true),
			array('id', 'safe'),
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;
		
		switch (strtolower($this->id)) {
			case 'a':
				$criteria->compare('t.banner_a','y');
				break;
			case 'b':
				$criteria->compare('t.banner_b','y');
				break;
			case 'c':
				$criteria->compare('t.banner_c','y');
				break;
		}
		
		//show active
		$criteria->compare('status',1);
		
		// Add more conditions for each property here

		return new CActiveDataProvider('Products', array(
			'criteria' => $criteria,
			// more options here, e.g. sorting, pagination, ...
			'pagination' => array('pageSize' => 12,'pageVar'=>'page',),
		));
	}
}


?>