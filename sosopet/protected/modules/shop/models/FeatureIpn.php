<?php

/**
 * This is the model class for table "shop_feature_ipn".
 *
 * The followings are the available columns in table 'shop_feature_ipn':
 * @property string $id
 * @property integer $product_id
 * @property string $sender_email
 * @property string $status
 * @property string $receive_time
 * @property string $receiver_email
 * @property string $amount
 */
class FeatureIpn extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shop_feature_ipn';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, product_id, status, receiver_email, amount, no_of_day', 'required'),
			array('product_id, no_of_day', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>20),
			array('sender_email, receiver_email', 'length', 'max'=>255),
			array('status', 'length', 'max'=>50),
			array('amount', 'length', 'max'=>45),
			array('receive_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, product_id, sender_email, status, receive_time, receiver_email, amount', 'safe', 'on'=>'search'),
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
			'product_id' => 'Product',
			'sender_email' => 'Sender Email',
			'status' => 'Status',
			'receive_time' => 'Receive Time',
			'receiver_email' => 'Receiver Email',
			'amount' => 'Amount',
			'no_of_day' => 'No of Days'
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
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('sender_email',$this->sender_email,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('receive_time',$this->receive_time,true);
		$criteria->compare('receiver_email',$this->receiver_email,true);
		$criteria->compare('amount',$this->amount,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FeatureIpn the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	public function updateFeatureDate() {
		$product = $this->product;
		if($product){
			$product->updateFeatureDate($this->no_of_day);
		}

	}
	
	public function updateGalleryDate() {
		$product = $this->product;
		if($product){
			$product->updateGalleryDate($this->no_of_day);
		}

	}
}
