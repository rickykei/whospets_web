<?php

/**
 * ChatForm class.
 * ChatForm is the data structure for keeping
 * chat form data. It is used by the 'chat' action of 'ChatController'.
 */
class ChatForm extends CFormModel
{
	public $recipient;
	public $title;
	public $message;
	public $product_id;
	public $pet_id;
	public $product_name;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('recipient, title, message, product_id,product_name', 'required'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}
	
	public function relations()
	{
		return array(
			'rcp' => array(self::BELONGS_TO, 'YumUser', 'recipient'),
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
			'recipient'=>'To',
			'title'=>Yii::t('shop','Subject'),
			'message'=>Yii::t('shop','Message'),
			'verifyCode'=>Yii::t('shop','Verification Code'),
			'product_id' => Yii::t('shop','Product_id'),
			'product_id' => Yii::t('shop','Product_name'),
		);
	}
	
	public function save()
	{
		if($this->validate()){
			$chat = new Chat();
			$message = new ChatMessage();
			
			$chat->recipient_id = $this->recipient;
			$chat->title = $this->title;
			$chat->user_id = Yii::app()->user->id;
			$chat->product_id = $this->product_id;
			//$chat->product_name = $this->product_name;
			$chat->save();
			$this->addErrors($chat->getErrors());
			//$model->addError('paywith', 'You dont have an email account for the requested payment.');
			//CHtml::errorSummary($model)
			$message->chat_id = $chat->id;
			$message->user_id = Yii::app()->user->id;
			$message->recipient_id = $this->recipient;
			$message->message = $this->message;
			//$message->read = '';
			$message->save();
			$this->addErrors($message->getErrors());
			
			return !$this->hasErrors();
		}else{
			return false;
		}
	}
}
