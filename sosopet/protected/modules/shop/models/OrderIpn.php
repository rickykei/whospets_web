<?php

/**
 * This is the model class for table "shop_order_ipn".
 *
 * The followings are the available columns in table 'shop_order_ipn':
 * @property string $tracking_id
 * @property integer $order_id
 * @property string $sender_email
 * @property string $pay_key
 * @property string $status
 * @property string $receive_time
 */
class OrderIpn extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shop_order_ipn';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tracking_id, order_id, status, receiver_email_1, amount_1, receiver_email_2, amount_2', 'required'),
			array('order_id', 'numerical', 'integerOnly'=>true),
			array('tracking_id', 'length', 'max'=>26),
			array('sender_email', 'length', 'max'=>255),
			array('pay_key, status', 'length', 'max'=>50),
			array('receive_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tracking_id, order_id, sender_email, pay_key, status, receive_time', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'tracking_id' => 'Tracking',
			'order_id' => 'Order',
			'sender_email' => 'Sender Email',
			'pay_key' => 'Pay Key',
			'status' => 'Status',
			'receive_time' => 'Receive Time',
			'receiver_email_1' => 'Receiver Eamil 1',
			'amount_1' => 'Amount 1',
			'receiver_email_2' => 'Receiver Eamil 2',
			'amount_2' => 'Amount 2',
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

		$criteria->compare('tracking_id',$this->tracking_id,true);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('sender_email',$this->sender_email,true);
		$criteria->compare('pay_key',$this->pay_key,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('receive_time',$this->receive_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderIpn the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function proceedOrder() {
		$order = $this->order;
		if($order){
			//ENUM('new','in_progress','done','cancelled')
			$order->proceedOrder();
		}
	}
}
