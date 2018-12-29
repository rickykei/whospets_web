<?php

/**
 * This is the model class a order position.
 *
 * The followings are the available columns in table 'shop_order_position':
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $amount
 * @property string $specifications
 */
class OrderPosition extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'shop_order_position';
	}

	public function rules()
	{
		return array(
			array('order_id, product_id, amount, specifications, store_id', 'required'),
			array('order_id, product_id, amount, store_id, variation_id', 'numerical', 'integerOnly'=>true),
			array('id, order_id, product_id, amount, specifications, store_id, variation_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'order' => array(self::BELONGS_TO, 'Order', 'order_id'),
			'product' => array(self::BELONGS_TO, 'Products', 'product_id'),
			'store' => array(self::BELONGS_TO, 'Store', 'store_id'),
			'variation' => array(self::BELONGS_TO, 'ProductVariation', 'variation_id'),
		);
	}

	public function getSpecifications() {
		$specs = json_decode($this->specifications, true);
		$specifications = array();
		if($specs)
			foreach($specs as $key => $specification) {
				$specifications[$key] = $specification;
			}

		return $specifications;
	}


	public function listSpecifications() {
		if(!$specs = $this->getSpecifications())
			return '';
	
		$str = '(';	
		foreach($specs as $key => $specification) {
			if($model = ProductSpecification::model()->findByPk($key))
				if($model->input_type == 'textfield')
					$value = $specification[0];
				else
					$value = @ProductVariation::model()->findByPk($specification[0])->title;

		$str .= $model->title. ': '.$value . ', ';
		}

		$str = substr($str, 0, -2);
		$str .= ')';

		return $str;
	}

	public function getPrice() {
		$price = $this->product->price;

		if($this->specifications)
			foreach($this->getSpecifications() as $key => $spec) 
				$price += @ProductVariation::model()->findByPk(@$spec[0])->price_adjustion;

		return $this->amount * $price;
	}

	public function updateStock($amount) {
		//Update stock
		$product = $this->product;
		if($product){
			$variation=$this->variation;
			if($variation){
				$variation->quantity = $variation->quantity - $amount;
				if($variation->quantity<0)
					$variation->quantity=0;
				$variation->save();
			}else{
				$product->quantity = $product->quantity - $amount;
				if($product->quantity<0)
					$product->quantity=0;
				$product->save();
			}
		}
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'order_id' => Shop::t('Order'),
			'product_id' => Shop::t('Product'),
			'amount' => Shop::t('Amount'),
			'specifications' => Shop::t('Specifications'),
			'store_id' => 'Store ID',
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
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('specifications',$this->specifications,true);
		$criteria->compare('store_id',$this->store_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
