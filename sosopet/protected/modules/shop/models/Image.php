<?php

class Image extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return Yii::app()->controller->module->imageTable;
	}

	public function rules()
	{
		return array(
			array('title, filename, product_id', 'required'),
			array('id, product_id', 'numerical', 'integerOnly'=>true),
			array('title, filename', 'length', 'max'=>255),
			//array('filename' => 'file', 'types' => 'png,gif,jpg,jpeg'),
			array('id, title, filename, product_id, is_default', 'safe', 'on'=>'search'),
			array('product_id','uploadLimit','limit'=>Shop::module()->imageLimit),
		);
	}

	public function relations()
	{
		return array(
			'Product' => array(self::BELONGS_TO, 'Products', 'product_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'title' => Yii::t('shop', 'Title'),
			'filename' => Yii::t('shop', 'Filename'),
			'product_id' => Yii::t('shop', 'Product'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('title',$this->title,true);

		$criteria->compare('filename',$this->filename,true);

		$criteria->compare('product_id',$this->product_id);

		return new CActiveDataProvider('Image', array(
			'criteria'=>$criteria,
		));
	}
	
	public function uploadLimit($attribute,$params)
	{
		$count = intval(Image::model()->countByAttributes(array(
            'product_id'=> $this->$attribute
        )));
		//echo Yii::trace(CVarDumper::dumpAsString($count),'vardump');
		//echo Yii::trace(CVarDumper::dumpAsString($params['limit']),'vardump');
		if($count>=$params['limit'])
		//if(true)
			$this->addError($attribute, 'No more than '.$params['limit'].' images can be uploaded!');
	}
	
	public function setDefault()
	{
		Yii::app()->db->createCommand("update shop_image set is_default=null where product_id=".$this->product_id)->query();
		$this->is_default='Y';
		return $this->save();
	}
}
