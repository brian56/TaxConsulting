<?php

/**
 * This is the model class for table "company".
 *
 * The followings are the available columns in table 'company':
 * @property string $id
 * @property integer $is_actived
 * @property string $name
 * @property string $name_en
 * @property string $rss_url
 * @property string $introduction
 *
 * The followings are the available model relations:
 * @property ChangeLog[] $changeLogs
 * @property Info[] $infos
 * @property LogEvent[] $logEvents
 * @property RssNotification[] $rssNotifications
 * @property User[] $users
 */
class Company extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, name_en, rss_url, introduction', 'required'),
			array('is_actived', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, is_actived, name, name_en, rss_url, introduction', 'safe', 'on'=>'search'),
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
			'changeLogs' => array(self::HAS_MANY, 'ChangeLog', 'company_id'),
			'infos' => array(self::HAS_MANY, 'Info', 'company_id'),
			'logEvents' => array(self::HAS_MANY, 'LogEvent', 'company_id'),
			'rssNotifications' => array(self::HAS_MANY, 'RssNotification', 'company_id'),
			'users' => array(self::HAS_MANY, 'User', 'company_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'is_actived' => 'Is Actived',
			'name' => 'Name',
			'name_en' => 'Name En',
			'rss_url' => 'Rss Url',
			'introduction' => 'Introduction',
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
		$criteria->compare('is_actived',$this->is_actived);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('name_en',$this->name_en,true);
		$criteria->compare('rss_url',$this->rss_url,true);
		$criteria->compare('introduction',$this->introduction,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Company the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getAllRssUrl() {
		$criteria = new CDbCriteria();
		$criteria->select = array('rss_url', 'id');
		$criteria->condition = 't.is_actived=:is_actived';
		$criteria->params = array(':is_actived'=>1);
		return $this->findAll($criteria);
	}
	
	public function afterSave() {
		$rss = new RssNotification();
		$rss->company_id = $this->id;
		$rss->last_post_pubDate =  date('Y-m-d H:i:s');
		$rss->insert ();
		
		$rawFeed = file_get_contents($this->rss_url);
		
		// give an XML object to be iterate
		$xml = new SimpleXMLElement($rawFeed);
		$criteria = new CDbCriteria();
		$criteria->condition = 't.company_id=:company_id';
		$criteria->params = array(':company_id'=>$this->id);
		$rss_notification = RssNotification::model()->find($criteria);
		foreach($xml->channel->item as $item)
		{
			//$post_pubDate = $item->pubDate;
			//$post_url = $item->link;
			//$post_title = $item->title;
			
			$info = new Info();
			$info->company_id = $this->id;
			$info->user_id = Yii::app()->user->getState('user_id');
			$info->date_create = strtotime($item->pubDate);
			$info->title = $item->title;
			$info->info_type_id = 1;
			$info->content = $item->link;
			$info->access_level_id = 1;
			$info->insert();
			//check for new rss post
// 			if(strtotime($post_pubDate)>strtotime($rss_notification->last_post_pubDate)) {
// 				$data.= $post_pubDate;
// 				$data.= "\n";
// 				//$userDeviceIds = User::model()->getCompanyUserDeviceIds($company->id);
// 				//SendNotification::actionPushMultiDevice($userDeviceIds, $post_title, $post_url);
// 			}
			
		}
		//echo $data;
	}
}
