<?php

/**
 * This is the model class for table "shop_chat_message".
 *
 * The followings are the available columns in table 'shop_chat_message':
 * @property integer $id
 * @property integer $chat_id
 * @property integer $user_id
 * @property string $message
 * @property string $created
 * @property string $modified
 */
class ChatMessage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shop_chat_message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('chat_id, user_id, message', 'required'),
			array('chat_id, user_id', 'numerical', 'integerOnly'=>true),
			array('message', 'length', 'max'=>255),
			array('read', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, chat_id, user_id, message, created, modified, read', 'safe', 'on'=>'search'),
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
			'chat' =>array(self::BELONGS_TO, 'Chat', 'chat_id'),
			'user' =>array(self::BELONGS_TO, 'YumUser', 'user_id'),
			'images' => array(self::HAS_MANY, 'ChatImage', 'message_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'chat_id' => Yii::t('shop','Chat'),
			'user_id' => Yii::t('shop','User'),
			'message' => Yii::t('shop','Message'),
			'created' => Yii::t('shop','Created'),
			'modified' => Yii::t('shop','Updated'),
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
		$criteria->compare('chat_id',$this->chat_id);
		$criteria->compare('user_id',Yii::app()->user->id);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->order = 'modified DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchMessages()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('t.user_id',Yii::app()->user->id);
		$criteria->addCondition('t.user_id = shop_chat.recipient_id', 'OR');
		$criteria->addCondition('t.user_id = shop_chat.user_id', 'OR');
		//$criteria->compare('shop_chat.recipient_id', Yii::app()->user->id, false, 'OR');
		
		$criteria->compare('id',$this->id);
		$criteria->compare('chat_id',$this->chat_id);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->join = 'left join shop_chat on t.chat_id = shop_chat.id';
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ChatMessage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave() {
		if ($this->isNewRecord) {
			$this->created = new CDbExpression('NOW()');
			$this->read = '';
		}
		$this->modified = new CDbExpression('NOW()');
		$this->chat->save();
	 
		return parent::beforeSave();
	}
	
	public function afterSave( ) {
		$this->addImages( );
		parent::afterSave( );
	}
	
	public function addImages( ) {
		//If we have pending images
		if( Yii::app( )->user->hasState( 'chatimages' ) ) {
			$userImages = Yii::app( )->user->getState( 'chatimages' );
			//Resolve the final path for our images
			$path = Yii::app( )->getBasePath( )."/../".Shop::module()->chatImagesFolder."{$this->id}/";
			$thumbPath = Yii::app( )->getBasePath( )."/../".Shop::module()->chatThumbImagesFolder."{$this->id}/";
			//Create the folder and give permissions if it doesnt exists
			if( !is_dir( $path ) ) {
				mkdir( $path );
				chmod( $path, 0777 );
			}
			if( !is_dir( $thumbPath ) ) {
				mkdir( $thumbPath );
				chmod( $thumbPath, 0777 );
			}
			chmod( $thumbPath, 0777 );
			//Now lets create the corresponding models and move the files
			foreach( $userImages as $image ) {
				if( is_file( $image["path"] ) && is_file($image["thumb"])) {
					if( rename( $image["path"], $path.$image["filename"] ) && rename( $image["thumb"], $thumbPath.$image["filename"] )) {
					//if( rename( $image["path"], $path.$image["filename"] ) ) {
						chmod( $path.$image["filename"], 0777 );
						chmod( $thumbPath.$image["filename"], 0777 );
						$img = new ChatImage();
						$img->title = $image["name"];
						$img->filename = "{$this->id}/".$image["filename"];
						$img->message_id = $this->id;
						if( !$img->save( ) ) {
							//Its always good to log something
							//Yii::log( "Could not save Image:\n".CVarDumper::dumpAsString( 
							//	$img->getErrors( ) ), CLogger::LEVEL_ERROR );
							//this exception will rollback the transaction
							throw new Exception( 'Could not save Image'.CHtml::errorSummary($img));
						}
					}
				} else {
					//You can also throw an execption here to rollback the transaction
					Yii::log( $image["path"]." is not a file", CLogger::LEVEL_WARNING );
				}
			}
			//Clear the user's session
			Yii::app( )->user->setState( 'chatimages', null );
		}
	}
}
