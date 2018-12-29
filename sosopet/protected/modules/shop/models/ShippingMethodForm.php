<?php

/**
 * ShippingMethodForm class.
 * ShippingMethodForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ShippingMethodForm extends CFormModel
{
	public $store_id;
	public $shippingOptions;
	public $country;
	public $fee;
	public $desc;
	
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			//array('cart', 'safe'),
			//array('cart', 'checkCart'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'store_id'=>'Store ID',
			'shippingOptions'=>'Shipping Methods',
		);
	}
}
