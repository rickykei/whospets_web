<?php

/**
 * This is the model class for table "shop_chat".
 *
 * The followings are the available columns in table 'shop_chat':
 * @property integer $id
 * @property integer $recipient_id
 * @property integer $user_id
 * @property string $title
 * @property string $created
 * @property string $modified
 */
class Chat extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shop_chat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('recipient_id, user_id, title, product_id', 'required'),
			array('recipient_id, user_id, product_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, recipient_id, user_id, title, created, modified, product_id', 'safe', 'on'=>'search'),
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
			'recipient' =>array(self::BELONGS_TO, 'YumUser', 'recipient_id'),
			'user' =>array(self::BELONGS_TO, 'YumUser', 'user_id'),
			'messages' => array(self::HAS_MANY, 'ChatMessage', 'id'),
			'product' =>array(self::BELONGS_TO, 'Products', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'recipient_id' => 'Recipient',
			'user_id' => Yii::t('shop','Sender'),
			'title' => Yii::t('shop','Subject'),
			'created' => 'Created',
			'modified' => Yii::t('shop','Updated'),
			'product_id' => 'Product',
			
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
		$criteria->compare('recipient_id',Yii::app()->user->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->order = 'modified DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchInbox()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->select = 't.id, t.recipient_id, t.user_id, t.title, t.created, t.modified';
		$criteria->compare('t.id',$this->id);
		//$criteria->compare('recipient_id',Yii::app()->user->id);
		//$criteria->compare('user_id',$this->user_id);
		//$criteria->compare('title',$this->title,true);
		//$criteria->compare('created',$this->created,true);
		//$criteria->compare('modified',$this->modified,true);
		$criteria->order = 't.modified DESC';
		
		$criteria->join='LEFT JOIN shop_chat_message ON shop_chat_message.chat_id=t.id';
		$criteria->compare('shop_chat_message.recipient_id',Yii::app()->user->id);
		$criteria->group = 't.id';
	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchSent()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->select = 't.id, t.recipient_id, t.user_id, t.title, t.created, t.modified';
		$criteria->compare('t.id',$this->id);
		//$criteria->compare('recipient_id',Yii::app()->user->id);
		//$criteria->compare('user_id',$this->user_id);
		//$criteria->compare('title',$this->title,true);
		//$criteria->compare('created',$this->created,true);
		//$criteria->compare('modified',$this->modified,true);
		$criteria->order = 't.modified DESC';
		
		$criteria->join='LEFT JOIN shop_chat_message ON shop_chat_message.chat_id=t.id';
		$criteria->compare('shop_chat_message.user_id',Yii::app()->user->id);
		$criteria->group = 't.id';
	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Chat the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave() {
		if ($this->isNewRecord)
			$this->created = new CDbExpression('NOW()');
	 
		$this->modified = new CDbExpression('NOW()');
	 
		return parent::beforeSave();
	}
	
	public function updateMessageRead()
	{
		/*
		//$sql="SELECT SUM(`feedback`)*100/count(*) FROM `shop_feedback` WHERE `feedback`>=0 and store_id=:store_id";
		$sql="UPDATE shop_chat_message SET `read`='Y' WHERE chat_id=:chat_id";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":chat_id", $this->id);
		$feedback=$command->queryScalar();
		//$feedback = Yii::app()->db->createCommand("SELECT SUM(`feedback`)*100/count(*) FROM `shop_feedback` WHERE `feedback`>=0")->queryScalar();
		//$score = Yii::app()->db->createCommand("SELECT SUM(`feedback`) FROM `shop_feedback` WHERE `feedback`>=0")->queryScalar();
		//$count = Yii::app()->db->createCommand("SELECT count(`feedback`) FROM `shop_feedback` WHERE `feedback`>=0")->queryScalar();
		//$feedback=$score*100/$count;
		return $feedback;
		*/
		
		Yii::app()->db->createCommand()->update(
			'shop_chat_message',
			array('read'=>'Y'),
			'chat_id=:chat_id and recipient_id=:recipient_id',
			array(':chat_id'=>$this->id, 'recipient_id'=>Yii::app()->user->id)
		);
	}
	
	public function isUnread()
	{
		$sql="SELECT COUNT(id) FROM shop_chat_message WHERE recipient_id=:recipient_id and chat_id=:chat_id and `read`<>'Y'";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":recipient_id", Yii::app()->user->id);
		$command->bindValue(":chat_id", $this->id);
		$count=$command->queryScalar();
		if($count>0){
			return true;
		}else{
			return false;
		}
	}
	
	public function getUnreadCount()
	{
		$sql="SELECT COUNT(*) FROM (SELECT t.id FROM shop_chat t LEFT JOIN
				shop_chat_message m ON m.chat_id=t.id WHERE
				m.recipient_id=:recipient_id and m.`read`<>'Y' GROUP BY t.id) sq";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":recipient_id", Yii::app()->user->id);
		$count=$command->queryScalar();
		return $count;
	}
}
