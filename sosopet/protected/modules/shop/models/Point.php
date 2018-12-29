<?php

/**
 * This is the model class for table "shop_point".
 *
 * The followings are the available columns in table 'shop_point':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $value
 * @property integer $threshold
 *
 * The followings are the available model relations:
 * @property Order[] $orders
 */
class Point extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Point the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return Yii::app()->getModule('shop')->pointTable;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description, value, threshold', 'required'),
			array('value, threshold', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('description', 'length', 'max'=>1024),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, description, value, threshold', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'orders' => array(self::HAS_MANY, 'Order', 'point_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => '名',
			'description' => '説明',
			'value' => '割引パーセント',
			'threshold' => 'しきい値',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('value',$this->value);
		$criteria->compare('threshold',$this->threshold);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}