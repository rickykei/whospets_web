<?php

/**
 * This is the model class for table "shop_feedback".
 *
 * The followings are the available columns in table 'shop_feedback':
 * @property string $id
 * @property string $user_id
 * @property string $store_id
 * @property integer $product_id
 * @property string $create_date
 * @property integer $feedback
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property Products $product
 * @property User $id0
 */
class Feedback extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shop_feedback';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, store_id, feedback, comment, product_id', 'required'),
			array('order_id, feedback, product_id', 'numerical', 'integerOnly'=>true),
			array('user_id, store_id', 'length', 'max'=>10),
			array('product_id', 'length', 'max'=>11),
			array('comment', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, store_id, order_id, create_date, feedback, comment, product_id', 'safe', 'on'=>'search'),
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
			'order' => array(self::BELONGS_TO, 'Order', 'order_id'),
			'user' => array(self::BELONGS_TO, 'YumUser', 'user_id'),
			'product' => array(self::BELONGS_TO, 'Products', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => Yii::t('shop','User'),
			'store_id' => 'Store',
			'order_id' => 'Order',
			'create_date' => 'Create Date',
			'feedback' => 'Feedback',
			'comment' =>Yii::t('shop', 'Your Review'),
			'product_id' => 'Product',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('store_id',$this->store_id,true);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('feedback',$this->feedback);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('product_id',$this->product_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchAll()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('store_id',$this->store_id,true);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('feedback',$this->feedback);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('product_id',$this->product_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>1000,
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Feedback the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave() {
		if ($this->isNewRecord)
			$this->create_date = new CDbExpression('NOW()');
	 
		return parent::beforeSave();
	}
}
