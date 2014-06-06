<?php

/**
 * This is the model class for table "log_event".
 *
 * The followings are the available columns in table 'log_event':
 * @property string $id
 * @property string $event_id
 * @property string $user_id
 * @property string $company_id
 * @property string $date_create
 *
 * The followings are the available model relations:
 * @property Event $event
 * @property Company $company
 * @property User $user
 */
class LogEvent extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'log_event';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array (
						'date_create',
						'default',
						'value' => new CDbExpression ( 'NOW()' ), // automatically add the current date in register_date
						'setOnEmpty' => false,
						'on' => 'insert'
				),
				array (
						'event_id, user_id, company_id',
						'required' 
				),
				array (
						'event_id, company_id',
						'length',
						'max' => 11 
				),
				array (
						'user_id',
						'length',
						'max' => 20 
				),
				// The following rule is used by search().
				// @todo Please remove those attributes that should not be searched.
				array (
						'id, event_id, user_id, company_id, date_create', 'safe', 'on'=>'search'),
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
			'event' => array(self::BELONGS_TO, 'Event', 'event_id'),
			'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'event_id' => 'Event',
			'user_id' => 'User',
			'company_id' => 'Company',
			'date_create' => 'Date Create',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('event_id',$this->event_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('date_create',$this->date_create,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LogEvent the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave()
	{
		if($this->isNewRecord)
		{
			$this->date_create= date('Y-m-d H:i:s');
		}
		return parent::beforeSave();
	}
}
