<?php

/**
 * This is the model class for table "log_event".
 *
 * The followings are the available columns in table 'log_event':
 * @property string $id
 * @property integer $user_id
 * @property string $user_email
 * @property integer $event_id
 * @property integer $info_id
 * @property string $info_title
 * @property integer $company_id
 * @property string $company_name
 * @property string $description
 * @property string $date_create
 *
 * The followings are the available model relations:
 * @property Event $event
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
			array('company_id', 'required'),
			array('user_id, event_id, info_id, company_id', 'numerical', 'integerOnly'=>true),
			array('date_create, company_name, description, user_email, info_id, info_title', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, user_email, event_id, info_id, info_title, company_id, company_name, description, date_create', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'user_email' => 'User Email',
			'event_id' => 'Event',
			'info_id' => 'Info',
			'info_title' => 'Info Title',
			'company_id' => 'Company',
			'company_name' => 'Company Name',
			'description' => 'Description',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('info_id',$this->info_id);
		$criteria->compare('info_title',$this->info_title,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('date_create',$this->date_create,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function searchCompanyEvents()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('info_id',$this->info_id);
		$criteria->compare('info_title',$this->info_title,true);
		$criteria->compare('company_id',Yii::app()->user->getState('globalId'));
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('description',$this->description,true);
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
}



