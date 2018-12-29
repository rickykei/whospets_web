<?php

class Order extends CActiveRecord
{
	public $user_id;


	public function limit($limit=5)
	{
		$this->getDbCriteria()->mergeWith(array(
					'limit'=>$limit,
					));
		return $this;
	}	

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return Shop::module()->orderTable;
	}

	public function rules()
	{
		return array(
			//array('customer_id, ordering_date, delivery_address_id, billing_address_id, payment_method', 'required'),
			array('customer_id, ordering_date, payment_method', 'required'),
			array('status', 'in', 'range' => array('new', 'in_progress', 'done', 'cancelled')),
			array('customer_id', 'numerical', 'integerOnly'=>true),
			//array('order_id, customer_id, ordering_date, status, comment, point_id, store_id', 'safe'),
			array('order_id, customer_id, ordering_date, status, comment, point_id, store_id, delivery_address_id, billing_address_id', 'safe'),
		);
	}

	public static function statusOptions() {
		return array(
			'new' => Shop::t('New'),
			'in_progress' => Shop::t('In progress'),
			'done' => Shop::t('Done'),
			'cancelled' => Shop::t('Cancelled')
		);

	}

	public function getStatus() {
		return Shop::t($this->status);
	}

	public function relations()
	{
		$relations = array(
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
			'positions' => array(self::HAS_MANY, 'OrderPosition', 'order_id'),
			'discounts' => array(self::HAS_MANY, 'DiscountPosition', 'order_id'),
			'address' => array(self::BELONGS_TO, 'Address', 'address_id'),
			'billingAddress' => array(self::BELONGS_TO, 'BillingAddress', 'billing_address_id'),
			'deliveryAddress' => array(self::BELONGS_TO, 'DeliveryAddress', 'delivery_address_id'),
			'paymentMethod' => array(self::BELONGS_TO, 'PaymentMethod', 'payment_method'),
			'shippingMethod' => array(self::BELONGS_TO, 'ShippingMethod', 'shipping_method'),
			'point' => array(self::BELONGS_TO, 'Point', 'point_id'),
			'store' => array(self::BELONGS_TO, 'Store', 'store_id'),
		);

		if(Shop::module()->useWithYum)
			$relations['user'] = array(self::HAS_ONE, 'YumUser', 'user_id', 'through' => 'customer');

		return $relations;
	}

	public function attributeLabels()
	{
		return array(
				'order_id' => Shop::t('Order number'),
				'customer_id' => Shop::t('Customer number'),
				'ordering_date' => Shop::t('Ordering Date'),
				'status' => Shop::t('Status'),
				'comment' => Shop::t('Comment'),
				);
	}

	public function getTaxAmount() {
		$amount = 0;
		if($this->positions)
			foreach($this->positions as $position)
				$amount += ($position->getPrice() * ($position->product->tax->percent / 100 + 1) ) - $position->getPrice();

		return $amount;
	}

	public function getTotalPrice() {
		$price = 0;
		if($this->positions)
			foreach($this->positions as $position)
				//$price += $position->getPrice();
				$price += $position->total_price;

		//if($this->shippingMethod)
		//	$price += $this->shippingMethod->price;

		return $price;
	}

	public function proceedOrder() {
		//Update stock
		if($this->positions){
			foreach($this->positions as $position)
			{
				$position->updateStock($position->amount);
			}
		}
		
		//ENUM('new','in_progress','done','cancelled')
		$this->status='in_progress';
		$this->save();
	}
	
	public function cancelOrder() {
		//ENUM('new','in_progress','done','cancelled')
		$this->status='cancelled';
		$this->save();
	}
	
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('t.order_id',$this->order_id);
		$criteria->compare('t.customer_id',$this->customer_id);
		$criteria->compare('t.ordering_date',$this->ordering_date,true);
		$criteria->compare('t.status',$this->status);
		$criteria->compare('t.store_id',$this->store_id);
		$criteria->order = "t.ordering_date DESC";

		// This code block is used mainly for searching for orders that a 
		// specific user has made (a 'through' join is done here)
		if($this->user_id !== null) {
			$criteria->join = '
				left join shop_customer on t.customer_id = shop_customer.customer_id 
				left join users on shop_customer.user_id = users.id';
			$criteria->compare('users.id', $this->user_id);
		}

		return new CActiveDataProvider('Order', array( 'criteria'=>$criteria,));
	}
	
	public function searchByStore()
	{
		$store = Store::model()->find('user_id = :user_id ', array(
						':user_id' => Yii::app()->user->id));
	
		$criteria=new CDbCriteria;

		$criteria->compare('t.order_id',$this->order_id);
		$criteria->compare('t.customer_id',$this->customer_id);
		$criteria->compare('t.ordering_date',$this->ordering_date,true);
		$criteria->compare('t.status',$this->status);
		$criteria->compare('t.store_id',$store->id);
		$criteria->order = "t.ordering_date DESC";


		// This code block is used mainly for searching for orders that a 
		// specific user has made (a 'through' join is done here)
		if($this->user_id !== null) {
			$criteria->join = '
				left join shop_customer on t.customer_id = shop_customer.customer_id 
				left join users on shop_customer.user_id = users.id';
			$criteria->compare('users.id', $this->user_id);
		}

		return new CActiveDataProvider('Order', array( 'criteria'=>$criteria,));
	}
	
	public function serarchByUser()
	{
		$customer = Customer::model()->find('user_id = :user_id ', array(
						':user_id' => Yii::app()->user->id));
						//echo Yii::trace(CVarDumper::dumpAsString(Yii::app()->user->id),'vardump111');
						//echo Yii::trace(CVarDumper::dumpAsString($customer),'vardump111');
		$criteria=new CDbCriteria;

		$criteria->compare('t.order_id',$this->order_id);
		$criteria->compare('t.customer_id',$customer->customer_id);
		$criteria->compare('t.ordering_date',$this->ordering_date,true);
		$criteria->compare('t.status',$this->status);
		$criteria->compare('t.store_id',$this->store_id);
		$criteria->order = "t.ordering_date DESC";
		//echo Yii::trace(CVarDumper::dumpAsString($criteria),'vardump111');
		//echo Yii::trace(CVarDumper::dumpAsString($this),'vardump111');
		return new CActiveDataProvider('Order', array( 'criteria'=>$criteria,));
	}
}
