<?php

/**
 * This is the model class for table "shop_app_profile".
 *
 * The followings are the available columns in table 'shop_app_profile':
 * @property string $code
 * @property string $description
 * @property string $val
 */
class AppProfile extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shop_app_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, description, val', 'required'),
			array('code', 'length', 'max'=>45),
			array('description, val', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('code, description, val', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'code' => 'Code',
			'description' => 'Description',
			'val' => 'Val',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('code',$this->code,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('val',$this->val,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AppProfile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getPayPalAPIUsername()
	{
		$profile=AppProfile::model()->findbyPk('payPalAPIUsername');
		if($profile){
			return $profile->val;
		}else{
			return '';
		}
	}
	
	public function getPayPalAPIPassword()
	{
		$profile=AppProfile::model()->findbyPk('payPalAPIPassword');
		if($profile){
			return $profile->val;
		}else{
			return '';
		}
	}
	
	public function getPayPalAPISignature()
	{
		$profile=AppProfile::model()->findbyPk('payPalAPISignature');
		if($profile){
			return $profile->val;
		}else{
			return '';
		}
	}
	
	public function getPayPalAPIAppID()
	{
		$profile=AppProfile::model()->findbyPk('payPalAPIAppID');
		if($profile){
			return $profile->val;
		}else{
			return '';
		}
	}
	
	public function getPayPalBusinessEmail()
	{
		$profile=AppProfile::model()->findbyPk('payPalBusinessEmail');
		if($profile){
			return $profile->val;
		}else{
			return '';
		}
	}
	
	public function getPayPalTestMode()
	{
		$profile=AppProfile::model()->findbyPk('payPalTestMode');
		if($profile && $profile->val==='1'){
			return true;
		}else{
			return false;
		}
	}
	
	public function getPayPercentage()
	{
		$profile=AppProfile::model()->findbyPk('payPercentage');
		if($profile){
			return (float)$profile->val;
		}else{
			return '';
		}
	}
	
	public function getFeatureProductFee()
	{
		$profile=AppProfile::model()->findbyPk('featureProductFee');
		if($profile){
			return (float)$profile->val;
		}else{
			return '';
		}
	}
	
	public function getGalleryProductFee()
	{
		$profile=AppProfile::model()->findbyPk('galleryProductFee');
		if($profile){
			return (float)$profile->val;
		}else{
			return '';
		}
	}
	
	public function getImageLimit()
	{
		$profile=AppProfile::model()->findbyPk('imageLimit');
		if($profile){
			return (float)$profile->val;
		}else{
			return '';
		}
	}
	
	public function getEmailHost()
	{
		$profile=AppProfile::model()->findbyPk('emailHost');
		if($profile){
			return $profile->val;
		}else{
			return '';
		}
	}
	
	public function getEmailPort()
	{
		$profile=AppProfile::model()->findbyPk('emailPort');
		if($profile){
			return (int)$profile->val;
		}else{
			return '';
		}
	}
	
	public function getEmailUsername()
	{
		$profile=AppProfile::model()->findbyPk('emailUsername');
		if($profile){
			return $profile->val;
		}else{
			return '';
		}
	}
	
	public function getEmailPassword()
	{
		$profile=AppProfile::model()->findbyPk('emailPassword');
		if($profile){
			return $profile->val;
		}else{
			return '';
		}
	}
	
	public function getEmailTransport()
	{
		$profile=AppProfile::model()->findbyPk('emailTransport');
		if($profile){
			return $profile->val;
		}else{
			return '';
		}
	}
	
	public function getLoginFacebookAppID()
	{
		$profile=AppProfile::model()->findbyPk('loginFacebookAppID');
		if($profile){
			return $profile->val;
		}else{
			return '';
		}
	}
	
	public function getLoginFacebookAppSecret()
	{
		$profile=AppProfile::model()->findbyPk('loginFacebookAppSecret');
		if($profile){
			return $profile->val;
		}else{
			return '';
		}
	}
	
	public function getLoginTwitterConsumerKey()
	{
		$profile=AppProfile::model()->findbyPk('loginTwitterConsumerKey');
		if($profile){
			return $profile->val;
		}else{
			return '';
		}
	}
	
	public function getLoginTwitterConsumerSecret()
	{
		$profile=AppProfile::model()->findbyPk('loginTwitterConsumerSecret');
		if($profile){
			return $profile->val;
		}else{
			return '';
		}
	}
	
	public function getMailTemplateRecoverBody()
	{
		$profile=AppProfile::model()->findbyPk('mailTemplateRecoverBody');
		if($profile){
			return $profile->val;
		}else{
			return 'You have requested a new password. Please use this URL to continue: {recovery_url}';
		}
	}
	
	public function getMailTemplateRecoverSubject()
	{
		$profile=AppProfile::model()->findbyPk('mailTemplateRecoverSubject');
		if($profile){
			return $profile->val;
		}else{
			return 'You requested a new password';
		}
	}
	
	public function getMailTemplateRegistrationBody()
	{
		$profile=AppProfile::model()->findbyPk('mailTemplateRegistrationBody');
		if($profile){
			return $profile->val;
		}else{
			return 'Hello, {username}. Please activate your account with this url: {activation_url}';
		}
	}
	
	public function getMailTemplateRegistrationSubject()
	{
		$profile=AppProfile::model()->findbyPk('mailTemplateRegistrationSubject');
		if($profile){
			return $profile->val;
		}else{
			return 'Please activate your account for {username}';
		}
	}
	
	public function getPayPalHandlingFeePercentage()
	{
		$profile=AppProfile::model()->findbyPk('payPalHandlingFeePercentage');
		if($profile){
			return (float)$profile->val;
		}else{
			return '';
		}
	}
	
	public function getFacebookLink()
	{
		$profile=AppProfile::model()->findbyPk('linkFacebook');
		if($profile){
			return $profile->val;
		}else{
			return '';
		}
	}
	
	public function getRSSLink()
	{
		$profile=AppProfile::model()->findbyPk('linkRSS');
		if($profile){
			return $profile->val;
		}else{
			return '';
		}
	}
	
	public function getTwitterLink()
	{
		$profile=AppProfile::model()->findbyPk('linkTwitter');
		if($profile){
			return $profile->val;
		}else{
			return '';
		}
	}
	
	public function getDribbbleLink()
	{
		$profile=AppProfile::model()->findbyPk('linkDribbble');
		if($profile){
			return $profile->val;
		}else{
			return '';
		}
	}
	
	public function getYouTubeLink()
	{
		$profile=AppProfile::model()->findbyPk('linkYouTube');
		if($profile){
			return $profile->val;
		}else{
			return '';
		}
	}
	
	public function getSkypeLink()
	{
		$profile=AppProfile::model()->findbyPk('linkSkype');
		if($profile){
			return $profile->val;
		}else{
			return '';
		}
	}
}
