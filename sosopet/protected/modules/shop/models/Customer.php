<?php

class Customer extends CActiveRecord
{
	public $terms_accepted = null;
	public $password;
	public $passwordRepeat;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return Yii::app()->getModule('shop')->customerTable;
	}

	public function rules()
	{
		return array(
			array('email, phone', 'required'),
			array('address_id, billing_address_id, delivery_address_id, customer_id', 'numerical', 'integerOnly'=>true),
			array('email', 'CEmailValidator'),
			array('customer_id, user_id, email', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'Orders' => array(self::HAS_MANY, 'Order', 'customer_id'),
			'ShoppingCarts' => array(self::HAS_MANY, 'ShoppingCart', 'customer_id'),
			'address' => array(self::BELONGS_TO, 'Address', 'address_id'),
			'billingAddress' => array(self::BELONGS_TO, 'BillingAddress', 'billing_address_id'),
			'deliveryAddress' => array(self::BELONGS_TO, 'DeliveryAddress', 'delivery_address_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'password' => Shop::t('Password'),
			'passwordRepeat' => Shop::t('repeat Password'),
			'customer_id' => Shop::t('Customer'),
			'user_id' => Shop::t('Userid'),
			'phone' => Shop::t('Phone'),
			'address_id' => Shop::t('Address'),
			'billing_address_id' => Shop::t('Billing Address'),
			'delivery_address_id' => Shop::t('Delivery Address'),
			'email' => Shop::t('Email'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('email',$this->email,true);
		return new CActiveDataProvider('Customer', array(
			'criteria'=>$criteria,
		));
	}
}
