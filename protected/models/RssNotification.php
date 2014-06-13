<?php

/**
 * This is the model class for table "rss_notification".
 *
 * The followings are the available columns in table 'rss_notification':
 * @property integer $id
 * @property string $company_id
 * @property integer $notify
 * @property string $last_post_pubDate
 * @property string $last_post_title
 * @property string $last_post_url
 *
 * The followings are the available model relations:
 * @property Company $company
 */
class RssNotification extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rss_notification';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, last_post_pubDate, last_post_title, last_post_url', 'required'),
			array('notify', 'numerical', 'integerOnly'=>true),
			array('company_id', 'length', 'max'=>11),
			array('last_post_pubDate', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, company_id, notify, last_post_pubDate, last_post_title, last_post_url', 'safe', 'on'=>'search'),
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
			'notify' => 'Notify',
			'last_post_pubDate' => 'Last Post Pub Date',
			'last_post_title' => 'Last Post Title',
			'last_post_url' => 'Last Post Url',
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
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('notify',$this->notify);
		$criteria->compare('last_post_pubDate',$this->last_post_pubDate,true);
		$criteria->compare('last_post_title',$this->last_post_title,true);
		$criteria->compare('last_post_url',$this->last_post_url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RssNotification the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
