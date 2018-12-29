<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactajaxForm extends CFormModel
{
	public $name;
	public $email;
	public $body;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('name, email, body', 'required'),
			// email has to be a valid email address
//			array('email', 'email'),
			// verifyCode needs to be entered correctly
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
			'name'=>'Your Name',
			'email'=>'E-Mail Address',
			'body'=>'Enquiry',
		);
	}
}
