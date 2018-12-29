<?php
class DiscountForm extends CFormModel
{
	public $category_id;
	public $discount;
	

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('category_id', 'required'),
			array('discount', 'type', 'type'=>'float'),
			array('category_id', 'numerical', 'integerOnly'=>true),
			array('discount', 'length', 'max'=>45),
		);
	}
	
	public function relations()
	{
		return array(
			'category' => array(CActiveRecord::BELONGS_TO, 'Category', 'category_id'),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'category_id'=>'Category',
			'discount'=>'Discount',
		);
	}
	
	public function save()
	{
		if($this->validate()){
			// Get products by category
			$products = Products::model()->findAll('category_id = :category_id ', array(
						':category_id' => $this->category_id));
			foreach ($products as $product){
				$product->discount = $this->discount;
				$product->save();
				$this->addErrors($product->getErrors());
			}
			
			
		/*
			$message = new ChatMessage();
			//$model->addError('paywith', 'You dont have an email account for the requested payment.');
			//CHtml::errorSummary($model)
			$message->chat_id = $this->chat_id;
			$message->user_id = Yii::app()->user->id;
			if($message->chat->user_id==$message->user_id){
				$message->recipient_id = $message->chat->recipient_id;
			}else{
				$message->recipient_id = $message->chat->user_id;
			}
			$message->message = $this->message;
			$message->save();
			$this->addErrors($message->getErrors());
		*/	
			return !$this->hasErrors();
		}else{
			return false;
		}
	}
}