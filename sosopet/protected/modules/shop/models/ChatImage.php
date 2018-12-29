<?php

class ChatImage extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return Yii::app()->controller->module->chatImageTable;
	}

	public function rules()
	{
		return array(
			array('title, filename, message_id', 'required'),
			array('id, message_id', 'numerical', 'integerOnly'=>true),
			array('title, filename', 'length', 'max'=>255),
			//array('filename' => 'file', 'types' => 'png,gif,jpg,jpeg'),
			array('id, title, filename, message_id, is_default', 'safe', 'on'=>'search'),
			array('message_id','uploadLimit','limit'=>Shop::module()->imageLimit),
		);
	}

	public function relations()
	{
		return array(
			'message' => array(self::BELONGS_TO, 'ChatMessage', 'message_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'filename' => Yii::t('shop', 'Filename'),
			'message_id' => Yii::t('shop', 'Message'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('filename',$this->filename,true);

		$criteria->compare('message_id',$this->message_id);

		return new CActiveDataProvider('ChatImage', array(
			'criteria'=>$criteria,
		));
	}
	
	public function uploadLimit($attribute,$params)
	{
		$count = intval(ChatImage::model()->countByAttributes(array(
            'message_id'=> $this->$attribute
        )));
		//echo Yii::trace(CVarDumper::dumpAsString($count),'vardump');
		//echo Yii::trace(CVarDumper::dumpAsString($params['limit']),'vardump');
		if($count>=$params['limit'])
		//if(true)
			$this->addError($attribute, 'No more than '.$params['limit'].' images can be uploaded!');
	}
	
	public function setDefault()
	{
		Yii::app()->db->createCommand("update shop_chat_image set is_default=null where message_id=".$this->message_id)->query();
		$this->is_default='Y';
		return $this->save();
	}
}
