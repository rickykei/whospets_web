<?php

class Country extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getChilds($id) {
		$data = array();

		foreach(Country::model()->findAll('parent_id = ' . $id) as $model) {
			$row['text'] = CHtml::link($model->title, array('//shop/country/view', 'id' => $model->country_id));
			$row['children'] = Country::getChilds($model->country_id);
			$data[] = $row;
		}
		return $data;
	}


	public function tableName()
	{
		return Yii::app()->getModule('shop')->countryTable;
	}

	public function rules()
	{
		return array(
				array('country_id', 'required'),
			array('country_id, parent_id', 'numerical', 'integerOnly'=>true),
			array('title, description, language', 'length', 'max'=>45),
			array('title', 'required'),
			array('country_id, parent_id, title, description, language', 'safe', 'on'=>'search'),
		);
	}

	public static function getListed() {
		$subitems = array();
		if($this->childs) foreach($this->childs as $child) {
			$subitems[] = $child->getListed();
		}
		$returnarray = array('label' => $this->title, 'url' => array('country/view', 'id' => $this->country_id));
		if($subitems != array()) $returnarray = array_merge($returnarray, array('items' => $subitems));
		return $returnarray;
	}

	public function relations()
	{
		return array(
			'Products' => array(self::HAS_MANY, 'Products', 'country_id'),
			'parent' => array(self::BELONGS_TO, 'Country', 'parent_id'),
			'childs' => array(self::HAS_MANY, 'Country', 'parent_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'country_id' => '#',
			'parent_id' => Shop::t('Parent'),
			'title' => Shop::t('country'),
		);
	}

	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('country_id',$this->country_id);

		$criteria->compare('parent_id',$this->parent_id);

		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider('Country', array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchProducts()
	{
		$criteria=new CDbCriteria;
		$product=new Products();
		//$product->store_id=$this->id;

		//$criteria->limit=10;
		//$criteria->order='feedback DESC';

		return new CActiveDataProvider($product, array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 10,),
		));
	}
}
