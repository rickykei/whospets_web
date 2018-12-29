<?php

/**
 * This is the model class for table "shop_store".
 *
 * The followings are the available columns in table 'shop_store':
 * @property integer $id
 * @property integer $user_id
 * @property string $store_banner
 * @property string $store_logo
 * @property string $store_name
 * @property string $store_description
 * @property string $store_email
 * @property string $store_phone
 * @property double $shipping_fee_us
 * @property double $shipping_fee_ca
 * @property double $shipping_fee_intl
 * @property double $additional_shipping_fee
 * @property string $shipping_info
 * @property string $policy
 * @property string $share_on_fb
 * @property string $hook_paypal
 * @property string $hook_facebook
 * @property string $hook_google
 * @property string $hook_twitter
 * @property string $hook_instagram
 * @property string $hook_pinterest
 * @property string $ship_us
 * @property string $ship_ca
 * @property string $ship_other
 */
class Store extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shop_store';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('user_id, store_name, store_description, store_phone, shipping_fee_us, additional_shipping_fee', 'required'),
			//array('store_name, store_description, store_phone, shipping_fee_us, additional_shipping_fee, hook_paypal, store_email', 'required'),
			array(' store_description, store_phone,  store_email', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('user_id', 'unique', 'message' => 'You already have your store'),
			array('shipping_fee_us, shipping_fee_ca, shipping_fee_intl, additional_shipping_fee', 'numerical'),
			array('store_banner, store_logo', 'length', 'max'=>255),
			array('store_name, store_email, hook_paypal, hook_facebook, hook_google, hook_twitter, hook_instagram, hook_pinterest', 'length', 'max'=>100),
			array('store_phone', 'length', 'max'=>50),
			array('share_on_fb, ship_us, ship_ca, ship_other', 'length', 'max'=>1),
			array('shipping_info, policy', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, store_banner, store_logo, store_name, store_description, store_email, store_phone, shipping_fee_us, shipping_fee_ca, shipping_fee_intl, additional_shipping_fee, shipping_info, policy, share_on_fb, hook_paypal, hook_facebook, hook_google, hook_twitter, hook_instagram, hook_pinterest, ship_us, ship_ca, ship_other', 'safe', 'on'=>'search'),
			array('store_banner', 'EPhotoValidator',
			'allowEmpty' => true,
			'mimeType' => array('image/jpeg', 'image/png', 'image/gif'),
			'maxWidth' => Shop::module()->bannerWidth,
			'maxHeight' => Shop::module()->bannerHeight,
			'minWidth' => 50,
			'minHeight' => 50,
			'on' => 'imageSizeCheck'),
			array('store_logo', 'EPhotoValidator',
			'allowEmpty' => true,
			'mimeType' => array('image/jpeg', 'image/png', 'image/gif'),
			'maxWidth' => Shop::module()->logoWidth,
			'maxHeight' => Shop::module()->logoHeight,
			'minWidth' => 50,
			'minHeight' => 50,
			'on' => 'imageSizeCheck'),
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
			'user' =>array(self::BELONGS_TO, 'YumUser', 'user_id'),
			'products' => array(self::HAS_MANY, 'Products', 'store_id'),
			'feedbacks' => array(self::HAS_MANY, 'Feedback', 'store_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User ID',
			'store_banner' => 'Store Banner',
			'store_logo' => 'Store Logo',
			'store_name' => 'Store Name',
			'store_description' => Yii::t('shop','Description'),
			'store_email' => Yii::t('shop','Email'),
			'store_phone' => Yii::t('shop','Phone'),
			'shipping_fee_us' => 'USA',
			'shipping_fee_ca' => 'Canada',
			'shipping_fee_intl' => 'International',
			'additional_shipping_fee' => 'Additional Products',
			'shipping_info' => 'Shipping Information',
			'policy' => 'Payment & Refund Policy',
			'share_on_fb' => 'Share on Facebook',
			'hook_paypal' => 'Paypal Email',
			'hook_facebook' => 'Facebook Name',
			'hook_google' => 'Google+',
			'hook_twitter' => 'Twitter Name',
			'hook_instagram' => 'Instagram',
			'hook_pinterest' => 'Pinterest',
			'ship_us' => 'United',
			'ship_ca' => 'Canada',
			'ship_other' => 'Rest of the world',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('store_banner',$this->store_banner,true);
		$criteria->compare('store_logo',$this->store_logo,true);
		$criteria->compare('store_name',$this->store_name,true);
		$criteria->compare('store_description',$this->store_description,true);
		$criteria->compare('store_email',$this->store_email,true);
		$criteria->compare('store_phone',$this->store_phone,true);
		$criteria->compare('shipping_fee_us',$this->shipping_fee_us);
		$criteria->compare('shipping_fee_ca',$this->shipping_fee_ca);
		$criteria->compare('shipping_fee_intl',$this->shipping_fee_intl);
		$criteria->compare('additional_shipping_fee',$this->additional_shipping_fee);
		$criteria->compare('shipping_info',$this->shipping_info,true);
		$criteria->compare('policy',$this->policy,true);
		$criteria->compare('share_on_fb',$this->share_on_fb,true);
		$criteria->compare('hook_paypal',$this->hook_paypal,true);
		$criteria->compare('hook_facebook',$this->hook_facebook,true);
		$criteria->compare('hook_google',$this->hook_google,true);
		$criteria->compare('hook_twitter',$this->hook_twitter,true);
		$criteria->compare('hook_instagram',$this->hook_instagram,true);
		$criteria->compare('hook_pinterest',$this->hook_pinterest,true);
		$criteria->compare('ship_us',$this->ship_us,true);
		$criteria->compare('ship_ca',$this->ship_ca,true);
		$criteria->compare('ship_other',$this->ship_other,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchTop10()
	{
		$criteria=new CDbCriteria;

		//$criteria->limit=10;
		$criteria->order='feedback DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 10,),
		));
	}
	
	public function searchFeedbacks()
	{
		$criteria=new CDbCriteria;
		$feedback=new Feedback();
		$feedback->store_id=$this->id;
		$criteria->compare('store_id',$this->id);

		//$criteria->limit=10;
		//$criteria->order='feedback DESC';

		return new CActiveDataProvider($feedback, array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 10,),
		));
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Store the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getStoreBanner($thumb = false)
	{
		if ($this->store_banner) {
			$options = array('class' => 'avatar', 'style' => 'height: ' . Shop::module()->bannerDisplayHeight . 'px;');
			$return = '<div class="avatar">';

			if (isset($this->store_banner) && $this->store_banner)
				$return .= CHtml::image(Yii::app()->baseUrl . '/'
						. $this->store_banner, 'Store Banner', $options);
			$return .= '</div><!-- store banner -->';
			return $return;
		}
	}
	
	public function getStoreLogo($thumb = false)
	{
		if ($this->store_logo) {
			$options = array('class' => 'avatar', 'style' => 'height: ' . Shop::module()->logoDisplayHeight . 'px;');
			$return = '<div class="avatar">';

			if (isset($this->store_logo) && $this->store_logo)
				$return .= CHtml::image(Yii::app()->baseUrl . '/'
						. $this->store_logo, 'Store Logo', $options);
			$return .= '</div><!-- store logo -->';
			return $return;
		}
	}
	
	public function getFeedback()
	{
		$sql="SELECT SUM(`feedback`)*100/count(*) FROM `shop_feedback` WHERE `feedback`>=0 and store_id=:store_id";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":store_id", $this->id);
		$feedback=$command->queryScalar();
		//$feedback = Yii::app()->db->createCommand("SELECT SUM(`feedback`)*100/count(*) FROM `shop_feedback` WHERE `feedback`>=0")->queryScalar();
		//$score = Yii::app()->db->createCommand("SELECT SUM(`feedback`) FROM `shop_feedback` WHERE `feedback`>=0")->queryScalar();
		//$count = Yii::app()->db->createCommand("SELECT count(`feedback`) FROM `shop_feedback` WHERE `feedback`>=0")->queryScalar();
		//$feedback=$score*100/$count;
		return round($feedback);
	}
}
