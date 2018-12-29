<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactForm extends CFormModel
{
	public $name;
	public $email;
	public $subject;
	public $body;
	public $petName;
	public $contactNo;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			//array('name, email, subject, body', 'required'),
			array('name, email, body,petName,contactNo', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
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
			'name'=>Yii::t('shop','Your Name'),
			'email'=>Yii::t('shop','E-Mail Address'),
			'body'=>Yii::t('shop','Postal Adress'),
			'petName'=>Yii::t('shop','Pet Name'),
			'contactNo'=>Yii::t('shop','Contact Tel. Number'),
			'verifyCode'=>Yii::t('shop','Verification Code'),
		);
	}
}
