<?php

/**
 * This is the model class for table "shop_size_guide".
 *
 * The followings are the available columns in table 'shop_size_guide':
 * @property string $code
 * @property string $seq
 */
class SizeGuide extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shop_size_guide';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, seq', 'required'),
			array('code', 'length', 'max'=>25),
			array('seq', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('code, seq', 'safe', 'on'=>'search'),
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
			'seq' => 'Seq',
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
		$criteria->compare('seq',$this->seq,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SizeGuide the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getSizeOptions()
	{
		$sizeOptions=SizeGuide::model()->findAll(array('order'=>'seq'));
		$options=array();
		
		
		if (Yii::app()->language=='zh'){
		foreach($sizeOptions as $sizeOption)
			$options[(string)$sizeOption->code_zh]=$sizeOption->code_zh;
		}	
		 else{
		foreach($sizeOptions as $sizeOption)
			$options[(string)$sizeOption->code]=$sizeOption->code;
		 	
		}
		//echo Yii::trace(CVarDumper::dumpAsString($options),'vardump10');
		//echo Yii::trace(CVarDumper::dumpAsString(CHtml::listData(SizeGuide::model()->findAll(array('order' => 'seq')),'code','code')),'vardump11');
		return $options;
	}
}
