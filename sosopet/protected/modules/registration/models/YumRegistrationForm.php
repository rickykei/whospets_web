<?php
/**
 * RegistrationForm class.
 * RegistrationForm is the data structure for keeping
 * user registration form data. It is used by the 'registration' action of 
 * 'YumRegistrationController'.
 * @package Yum.models
 */
class YumRegistrationForm extends YumUser {
  public $email;
  public $terms;
  public $newsletter;
  public $username;
  public $password;
  public $street;
  public $city;
  public $telephone;
  public $verifyPassword;
  public $verifyCode; // Captcha

  public function rules() 
  {
    $rules = parent::rules();

    if(!(Yum::hasModule('registration') && Yum::module('registration')->registration_by_email))
      $rules[] = array('username', 'required');

    $rules[] = array('newsletter, terms', 'safe');
    // password requirement is already checked in YumUser model, its sufficient
    // to check for verifyPassword here
    $rules[] = array('verifyPassword', 'required');
    $rules[] = array('password', 'compare',
      'compareAttribute'=>'verifyPassword',
      'message' => Yum::t("Retype password is incorrect."));

    if(Yum::module('registration')->enableCaptcha && !Yum::module()->debug)
      $rules[] = array('verifyCode', 'captcha',
        'allowEmpty'=>CCaptcha::checkRequirements()); 

    return $rules;
  }

  public static function genRandomString($length = 10)
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string ='';    
    for ($p = 0; $p < $length; $p++)
    {
      $string .= $characters[mt_rand(0, strlen($characters)-1)];
    }
    return $string;
  }
  
  public function attributeLabels()
	{
		return array(
				'email' => Yii::t('shop','Email Address'),
				'username' => Yii::t('shop','User Name'),
				'password' => Yii::t('shop','Password'),
				'verifyPassword' => Yii::t('shop','Confirm Password'),
				'verifyCode' => Yii::t('shop','Verification code'),
				'activationKey' => Yii::t('shop','Activation key'),
				'createtime' => Yii::t('shop','Registration date'),
				'lastvisit' => Yii::t('shop','Last visit'),
				'lastaction' =>Yii::t('shop','Online status'),
				'superuser' => Yii::t('shop','Superuser'),
				'status' => Yii::t('shop','Status'),
				'avatar' =>Yii::t('shop', 'Avatar image'),
				);
	}
}
