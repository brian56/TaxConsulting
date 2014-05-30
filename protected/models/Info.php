<?php

/**
 * This is the model class for table "info".
 *
 * The followings are the available columns in table 'info':
 * @property string $id
 * @property string $info_type_id
 * @property string $user_id
 * @property string $company_id
 * @property integer $status
 * @property string $title
 * @property string $content
 * @property string $date_create
 * @property string $date_update
 * @property string $access_level_id
 *
 * The followings are the available model relations:
 * @property AccessLevel $accessLevel
 * @property Company $company
 * @property InfoType $infoType
 * @property User $user
 * @property InfoComment[] $infoComments
 */
class Info extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('info_type_id, user_id, company_id, status, title, content, date_create, date_update, access_level_id', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('info_type_id, company_id', 'length', 'max'=>11),
			array('user_id', 'length', 'max'=>20),
			array('access_level_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, info_type_id, user_id, company_id, status, title, content, date_create, date_update, access_level_id', 'safe', 'on'=>'search'),
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
			'accessLevel' => array(self::BELONGS_TO, 'AccessLevel', 'access_level_id'),
			'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
			'infoType' => array(self::BELONGS_TO, 'InfoType', 'info_type_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'infoComments' => array(self::HAS_MANY, 'InfoComment', 'info_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'info_type_id' => 'Info Type',
			'user_id' => 'User',
			'company_id' => 'Company',
			'status' => 'Status',
			'title' => 'Title',
			'content' => 'Content',
			'date_create' => 'Date Create',
			'date_update' => 'Date Update',
			'access_level_id' => 'Access Level',
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
		$criteria->compare('info_type_id',$this->info_type_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('date_update',$this->date_update,true);
		$criteria->compare('access_level_id',$this->access_level_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Info the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
