<?php

class YumProfile extends YumActiveRecord
{

	public function recentComments($count = 3) {
		$criteria = new CDbCriteria;
		$criteria->condition = 'id = ' .$this->id;
		$criteria->order = 'createtime DESC';
		$criteria->limit = $count;
		return YumProfileComment::model()->findAll($criteria);
	}

	/**
	 * @param string $className
	 * @return YumProfile
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Returns resolved table name 
	 * @return string
	 */
	public function tableName()
	{
		$this->_tableName = Yum::module('profile')->profileTable;
		return $this->_tableName;
	}

	// define your project-specific profile field rules in your 
	// config/main.php  'profile' => 'profileRules' section
	public function rules() {
		$rules = array();
		foreach(YumProfile::getProfileFields() as $field){
		 
			$rules[] = array($field, 'safe');
		}
		foreach(Yum::module('profile')->requiredProfileFields as $field){
			 
			$rules[] = array($field, 'required');
		}
	
		$rules[] = array('birthday', 'type', 'type' => 'date', 'message' => '{attribute}: is not a date!', 'dateFormat' => 'yyyy-MM-dd');
		$rules = array_merge($rules, Yum::module('profile')->profileRules);	

		return $rules;

	}

	public function relations()
	{
		return array(
				'user' => array(self::BELONGS_TO, 'YumUser', 'user_id'),
				'comments' => array(self::HAS_MANY, 'YumProfileComment', 'profile_id'),
				 'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
				 'sub_country' => array(self::BELONGS_TO, 'Country', 'sub_country_id'),
				);
	}

	public static function getProfileFields() {
		$profile = new YumProfile();
		$fields = array();
		foreach($profile->attributes as $field => $value)
			if($field != 'id' && $field != 'user_id')
				$fields[] = $field;
		return $fields;
	}

	// Retrieve a list of all users that have commented my profile
	// Do not show my own profile visit
	public function getProfileCommentators() {
		$commentators = array();
		foreach($this->comments as $comment)
			if($comment->user_id != Yii::app()->user->id)
				$commentators[$comment->user_id] = $comment->user;

		return $commentators;
	}

	public function name() {
		return sprintf('%s %s', $this->firstname, $this->lastname);
	}

	public function attributeLabels()
	{
		/*****
		$labels = array(
				'id' => Yum::t('Profile ID'),
				'user_id' => Yum::t('User ID'),
				);

		foreach (YumProfile::getProfileFields() as $field)
				$labels[$field] = Yum::t($field);

		$labels['email'] = 'Email Address';
		$labels['newsletter'] = 'Sign Up for Newsletter';
		$labels['seller'] = 'I want to be a seller!';
		$labels['tc'] = 'I agree with the terms of service.';		
		return $labels;
		*******/
		return array(
		/*********
			'id' => Yum::t('Profile ID'),
			'user_id' => Yum::t('User ID'),
			'lastname' => Yum::t('Last Name'),
			'firstname' => Yum::t('First Name'),
			'email' => Yum::t('Email Address'),
			'street' => Yum::t('Street'),
			'city' => Yum::t('City'),
			'about' => Yum::t('About'),
			'newsletter' => Yum::t('Sign Up for Newsletter'),
			'seller' => Yum::t('I want to be a seller!'),
			'tc' => Yum::t('I agree with the terms of service.'),
			'notification' => Yum::t('Receive email notification for incoming private messages'),
			'gender' => Yum::t('Gender'),
			'birthday' => Yum::t('Birthday'),
			'picture' => Yum::t('Picture'),
			'bio' => Yum::t('Bio'),
			**************/
			'id' => 'Profile ID',
			'user_id' => 'User ID',
			'lastname' => Yii::t('shop','Last Name'),
			'firstname' => Yii::t('shop','First Name'),
			'email' => Yii::t('shop','Email Address'),
			'street' => 'Street',
			'city' => 'City',
			'about' => 'About',
			'newsletter' => 'Sign Up for Newsletter',
			'seller' => 'I want to be a seller!',
			'tc' => 'I agree with the terms of service.',
			'notification' => 'Receive email notification for incoming private messages',
			'gender' => Yii::t('shop','Gender'),
			'birthday' => 'Birthday',
			'picture' => 'Picture',
			'bio' => 'Bio',
			'country' => Yii::t('shop','Country'),
			'sub_country_id' => Yii::t('shop','district'),
		);
	}

	public function afterSave() {
		if($this->isNewRecord)
			Yii::log(Yum::t( 'A profile has been created: {profile}', array(
							'{profile}' => json_encode($this->attributes))));
		else
			Yii::log(Yum::t( 'A profile has been updated: {profile}', array(
							'{profile}' => json_encode($this->attributes))));

		return parent::afterSave();
	}


}
