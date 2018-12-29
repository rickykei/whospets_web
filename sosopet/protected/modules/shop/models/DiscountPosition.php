<?php

/**
 * This is the model class a order position.
 *
 * The followings are the available columns in table 'shop_order_position':
 * @property integer $id
 * @property integer $order_id
 * @property integer $amount
 * @property string $specifications
 */
class DiscountPosition extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'shop_discount_position';
	}

	public function rules()
	{
		return array(
			array('order_id, amount, specifications', 'required'),
			array('order_id, amount', 'numerical', 'integerOnly'=>true),
			array('id, order_id, amount, specifications', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'order' => array(self::BELONGS_TO, 'Order', 'order_id'),
		);
	}

	public function getPrice() {
		return $this->amount;
	}


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'order_id' => Shop::t('Order'),
			'amount' => Shop::t('Amount'),
			'specifications' => Shop::t('Specifications'),
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
		$criteria->compare('amount',$this->amount);
		$criteria->compare('specifications',$this->specifications,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
