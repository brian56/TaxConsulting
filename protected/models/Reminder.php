<?php

/**
 * This is the model class for table "reminder".
 *
 * The followings are the available columns in table 'reminder':
 * @property integer $id
 * @property integer $company_id
 * @property integer $user_id
 * @property string $date
 * @property integer $title
 * @property integer $content
 * @property string $user_receive
 * @property integer $alarm_setting
 * @property integer $alarm_time
 *
 * The followings are the available model relations:
 * @property Company $company
 * @property User $user
 */
class Reminder extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reminder';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, user_id, date, title, content, user_receive, alarm_setting, alarm_time', 'required'),
			array('company_id, user_id, title, content, alarm_setting, alarm_time', 'numerical', 'integerOnly'=>true),
			array('user_receive', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, company_id, user_id, date, title, content, user_receive, alarm_setting, alarm_time', 'safe', 'on'=>'search'),
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
			'company_id' => 'Company',
			'user_id' => 'User',
			'date' => 'Date',
			'title' => 'Title',
			'content' => 'Content',
			'user_receive' => 'User Receive',
			'alarm_setting' => 'Alarm Setting',
			'alarm_time' => 'Alarm Time',
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
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('title',$this->title);
		$criteria->compare('content',$this->content);
		$criteria->compare('user_receive',$this->user_receive,true);
		$criteria->compare('alarm_setting',$this->alarm_setting);
		$criteria->compare('alarm_time',$this->alarm_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Reminder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
