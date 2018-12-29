<?php

/**
 * ShoppingCartForm class.
 * ShoppingCartForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ShoppingCartForm extends CFormModel
{
	public $cart;
	
	
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
			array('cart', 'safe'),
			array('cart', 'checkCart'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'cart'=>'Shopping Cart',
		);
	}
	
	public function checkCart($attribute,$params)
	{
		echo Yii::trace(CVarDumper::dumpAsString($this->$attribute),'vardump');
		$tempCart=array();
		$tempStore=array();
		if($this->$attribute){
			foreach($this->$attribute as $c){
				$product_id=$c['product_id'];
				$amount=$c['amount'];
				$product_key=$product_id;
				$variation='';
				//$this->_validate_store($c, $prev_store_id);
				if(isset($c['Variations'])){
					$variation=$c['Variations'][1][0];
					$product_key=$product_id.'.'.$variation;
					if(array_key_exists($product_key,$tempCart)){
						//$tempCart[$product_id]=array('product_id'=>$product_id,'amount'=>$amount,);
						$tempCart[$product_key]['amount']=$tempCart[$product_key]['amount']+$amount;
					}else{
						$tempCart[$product_key]=array('product_id'=>$product_id,'amount'=>$amount,'variation'=>$variation);
					}
				}else{
					if(array_key_exists($product_id,$tempCart)){
						//$tempCart[$product_id]=array('product_id'=>$product_id,'amount'=>$amount,);
						$tempCart[$product_id]['amount']=$tempCart[$product_id]['amount']+$amount;
					}else{
						$tempCart[$product_id]=array('product_id'=>$product_id,'amount'=>$amount,'variation'=>$variation);
					}
				}
			}
			echo Yii::trace(CVarDumper::dumpAsString($tempCart),'vardump');
			
			foreach($tempCart as $c){
				$product = Products::model()->findByPk($c['product_id']);
				if($product){
					if($c['variation']!==''){
						$variations=$product->variations;
						foreach ($variations as $var){
							if ($var->id==$c['variation']){
								if($var->quantity<$c['amount'])
									$this->addError('cart','Not enough stock ('.$product->title.')');
								$store_id=$product->store->id;
								$tempStore[$store_id]=$store_id;
							}
						}
					}else{
						if($product->quantity<$c['amount'])
							$this->addError('cart','Not enough stock ('.$product->title.')');
						
						$store_id=$product->store->id;
						$tempStore[$store_id]=$store_id;
					}
				}else{
				}
			}
			
			if (count($tempStore)>1){
				$this->addError('cart','You have to add products from the same store');
			}
		}
	}
}
