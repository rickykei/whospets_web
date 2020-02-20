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
class AppComment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'app_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, content_id, comment' , 'required'),
			array('id, content_id,user_id', 'numerical', 'integerOnly'=>true),
			array('user_id, content_id', 'length', 'max'=>10),
			array('content_id', 'length', 'max'=>11),
			array('comment', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id,  content_id, created_date', 'safe', 'on'=>'search'),
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
			'lifestyle' => array(self::BELONGS_TO, 'Lifestyles', 'content_id'),
			'qna' => array(self::BELONGS_TO, 'Qnas', 'content_id'),
			'sell' => array(self::BELONGS_TO, 'Sells', 'content_id'),
			'user' => array(self::BELONGS_TO, 'YumUser', 'user_id'),
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
			'created_date' => 'Created Date',
			'comment' =>Yii::t('shop', 'Your Review'),
			'content_id' => 'content_id',
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
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('content_id',$this->content_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchAll()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		//$criteria->compare('id',$this->id,false);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('content_id',$this->content_id,true);
		$criteria->compare('table_name',$this->table_name,false);
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
			$this->created_date = new CDbExpression('NOW()');
	 
		return parent::beforeSave();
	}
}
