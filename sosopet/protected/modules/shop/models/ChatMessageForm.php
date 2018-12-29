<?php

/**
 * ChatForm class.
 * ChatForm is the data structure for keeping
 * chat form data. It is used by the 'chat' action of 'ChatController'.
 */
class ChatMessageForm extends CFormModel
{
	public $chat_id;
	public $message;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('chat_id, message', 'required'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}
	
	public function relations()
	{
		return array(
			'chat' => array(self::BELONGS_TO, 'Chat', 'chat_id'),
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
			'chat_id'=>'Chat',
			'message'=>Yii::t('shop','Message'),
			'verifyCode'=>Yii::t('shop','Verification Code'),
		);
	}
	
	public function save()
	{
		if($this->validate()){
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
			
			return !$this->hasErrors();
		}else{
			return false;
		}
	}
}