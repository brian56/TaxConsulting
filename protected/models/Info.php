<?php

/**
 * This is the model class for table "info".
 *
 * The followings are the available columns in table 'info':
 * @property integer $id
 * @property integer $info_type_id
 * @property integer $user_id
 * @property integer $company_id
 * @property integer $appointment_status
 * @property string $title
 * @property string $content
 * @property string $appointment_date
 * @property string $date_create
 * @property string $date_update
 * @property integer $access_level_id
 * @property integer $receiver_id
 *
 * The followings are the available model relations:
 * @property User $receiver
 * @property Company $company
 * @property AccessLevel $accessLevel
 * @property InfoType $infoType
 * @property User $user
 * @property InfoComment[] $infoComments
 */
class Info extends CActiveRecord {
	// add new attributes to model
	public function getInfoUserName() {
		return $this->user->email;
	}
	public function getInfoTypeName() {
		return Yii::t('strings',$this->infoType->name);
	}
	public function getInfoCompany() {
		if (isset ( $this->company ))
			return $this->company->name;
	}
	public function getInfoCommentsCount() {
		return count ( $this->infoComments );
	}
	public function getInfoAccessLevelName() {
			return Yii::t('strings',$this->accessLevel->name);
		}
		public function getAppointmentStatusName() {
			if($this->appointment_status==0) {
				return Yii::t('strings','Pending');
			} elseif ($this->appointment_status==1) {
				return Yii::t('strings','Confirmed');
			} else return Yii::t('strings','Rejected');
		}
	public function getInfoTimeCreate() {
		return strtotime ( $this->date_create ) * 1000;
	}
	public function getReceiverName() {
		if (isset ( $this->receiver )) {
			return $this->receiver->email;
		}
	}
	public function getAttributes($names = true) {
		$attrs = parent::getAttributes ( $names );
		$attrs ['infoUserName'] = $this->getInfoUserName ();
		$attrs ['infoTypeName'] = $this->getInfoTypeName ();
		$attrs ['infoCommentsCount'] = $this->getInfoCommentsCount ();
		$attrs ['infoAccessLevelName'] = $this->getInfoAccessLevelName ();
		$attrs ['infoTimeCreate'] = $this->getInfoTimeCreate ();
		$attrs ['infoCompany'] = $this->getInfoCompany ();
		$attrs ['receiverName'] = $this->getReceiverName ();
		$attrs ['appointmentStatusName'] = $this->getAppointmentStatusName ();
		
		return $attrs;
	}
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'info';
	}
	
	/**
	 *
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array (
				array (
						'user_id, title, content',
						'required' 
				),
				array (
						'info_type_id, user_id, company_id, appointment_status, access_level_id',
						'numerical',
						'integerOnly' => true 
				),
				array (
						'title, receiver_id, content, date_create, date_update, userName, appointment_date',
						'safe' 
				),
				// The following rule is used by search().
				// @todo Please remove those attributes that should not be searched.
				array (
						'id, info_type_id, receiver_id, user_id, company_id, appointment_status, title, content, appointment_date, date_create, date_update, access_level_id',
						'safe',
						'on' => 'search' 
				) 
		);
	}
	
	/**
	 *
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array (
				'receiver' => array (
						self::BELONGS_TO,
						'User',
						'receiver_id' 
				),
				'company' => array (
						self::BELONGS_TO,
						'Company',
						'company_id' 
				),
				'accessLevel' => array (
						self::BELONGS_TO,
						'AccessLevel',
						'access_level_id' 
				),
				'infoType' => array (
						self::BELONGS_TO,
						'InfoType',
						'info_type_id' 
				),
				'user' => array (
						self::BELONGS_TO,
						'User',
						'user_id' 
				),
				'infoComments' => array (
						self::HAS_MANY,
						'InfoComment',
						'info_id' 
				) 
		);
	}
	
	/**
	 *
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array (
				'id' => 'ID',
				'info_type_id' => Yii::t ( 'strings', 'Info Type' ),
				'user_id' => Yii::t ( 'strings', 'Author' ),
				'hospital_id' => Yii::t ( 'strings', 'Hospital' ),
				'appointment_status' => Yii::t ( 'strings', 'Appointment Status' ),
				'title' => Yii::t ( 'strings', 'Title' ),
				'content' => Yii::t ( 'strings', 'Content' ),
				'receiver_id' => Yii::t ( 'strings', 'Receiver' ),
				'appointment_date' => Yii::t ( 'strings', 'Appointment Date' ),
				'date_create' => Yii::t ( 'strings', 'Date Create' ),
				'date_update' => Yii::t ( 'strings', 'Date Update' ),
				'access_level_id' => Yii::t ( 'strings', 'Access Level' ) 
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
	 *         based on the search/filter conditions.
	 */
	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria = new CDbCriteria ();
		
		$criteria->compare ( 'id', $this->id );
		$criteria->compare ( 'info_type_id', $this->info_type_id );
		$criteria->compare ( 'user_id', $this->user_id );
		$criteria->compare ( 'company_id', $this->company_id );
		$criteria->compare ( 'appointment_status', $this->appointment_status );
		$criteria->compare ( 'title', $this->title, true );
		$criteria->compare ( 'content', $this->content, true );
		$criteria->compare ( 'appointment_date', $this->appointment_date, true );
		$criteria->compare ( 'date_create', $this->date_create, true );
		$criteria->compare ( 'date_update', $this->date_update, true );
		$criteria->compare ( 'access_level_id', $this->access_level_id );
		if (! isset ( $_GET ['Info_sort'] ))
			$criteria->order = 'date_create DESC';
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria,
				'pagination' => array (
						'pageSize' => 20 
				) 
		) );
	}
	public function searchQuestion($company_id) {
		$criteria = new CDbCriteria ();
		$criteria->compare ( 't.id', $this->id );
		$criteria->compare ( 't.info_type_id', 3 );
		$criteria->compare ( 't.user_id', $this->user_id );
		$criteria->compare ( 't.company_id', $company_id );
		$criteria->compare ( 't.appointment_status', $this->appointment_status );
		$criteria->compare ( 't.title', $this->title, true );
		$criteria->compare ( 't.content', $this->content, true );
		$criteria->compare ( 't.appointment_date', $this->appointment_date, true );
		$criteria->compare ( 't.date_create', $this->date_create, true );
		$criteria->compare ( 't.date_update', $this->date_update, true );
		$criteria->compare ( 't.access_level_id', $this->access_level_id );
		if (! isset ( $_GET ['Info_sort'] ))
			$criteria->order = 'date_create DESC';
			// $criteria->with = array('company', 'user', 'infoType', 'accessLevel', 'infoComments');
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria,
				'pagination' => array (
						'pageSize' => 20 
				) 
		) );
	}
	public function searchIndividualPage($company_id) {
		$criteria = new CDbCriteria ();
		$criteria->compare ( 't.id', $this->id );
		$criteria->compare ( 't.info_type_id', 3 );
		$criteria->compare ( 't.user_id', $this->user_id );
		$criteria->compare ( 't.company_id', $company_id );
		$criteria->compare ( 't.appointment_status', $this->appointment_status );
		$criteria->compare ( 't.title', $this->title, true );
		$criteria->compare ( 't.content', $this->content, true );
		$criteria->compare ( 't.appointment_date', $this->appointment_date, true );
		$criteria->compare ( 't.date_create', $this->date_create, true );
		$criteria->compare ( 't.date_update', $this->date_update, true );
		$criteria->compare ( 't.access_level_id', $this->access_level_id );
		if (! isset ( $_GET ['Info_sort'] ))
			$criteria->order = 'date_create DESC';
			// $criteria->with = array('company', 'user', 'infoType', 'accessLevel', 'infoComments');
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria,
				'pagination' => array (
						'pageSize' => 20 
				) 
		) );
	}
	public function searchNotice($company_id) {
		$criteria = new CDbCriteria ();
		$criteria->compare ( 't.id', $this->id );
		$criteria->compare ( 't.info_type_id', 1 );
		$criteria->compare ( 't.user_id', $this->user_id );
		$criteria->compare ( 't.company_id', $company_id );
		$criteria->compare ( 't.appointment_status', $this->appointment_status );
		$criteria->compare ( 't.title', $this->title, true );
		$criteria->compare ( 't.content', $this->content, true );
		$criteria->compare ( 't.appointment_date', $this->appointment_date, true );
		$criteria->compare ( 't.date_create', $this->date_create, true );
		$criteria->compare ( 't.date_update', $this->date_update, true );
		$criteria->compare ( 't.access_level_id', $this->access_level_id );
		if (! isset ( $_GET ['Info_sort'] ))
			$criteria->order = 'date_create DESC';
			// $criteria->with = array('company', 'user', 'infoType', 'accessLevel', 'infoComments');
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria,
				'pagination' => array (
						'pageSize' => 20 
				) 
		) );
	}
	public function searchTaxInfo($company_id) {
		$criteria = new CDbCriteria ();
		$criteria->compare ( 't.id', $this->id );
		$criteria->compare ( 't.info_type_id', 2 );
		$criteria->compare ( 't.user_id', $this->user_id );
		$criteria->compare ( 't.company_id', $company_id );
		$criteria->compare ( 't.appointment_status', $this->appointment_status );
		$criteria->compare ( 't.title', $this->title, true );
		$criteria->compare ( 't.content', $this->content, true );
		$criteria->compare ( 't.appointment_date', $this->appointment_date, true );
		$criteria->compare ( 't.date_create', $this->date_create, true );
		$criteria->compare ( 't.date_update', $this->date_update, true );
		$criteria->compare ( 't.access_level_id', $this->access_level_id );
		if (! isset ( $_GET ['Info_sort'] ))
			$criteria->order = 'date_create DESC';
			// $criteria->with = array('company', 'user', 'infoType', 'accessLevel', 'infoComments');
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria,
				'pagination' => array (
						'pageSize' => 20 
				) 
		) );
	}
	public function searchAppointment($company_id) {
		$criteria = new CDbCriteria ();
		$criteria->compare ( 't.id', $this->id );
		$criteria->compare ( 't.info_type_id', 4 );
		$criteria->compare ( 't.user_id', $this->user_id );
		$criteria->compare ( 't.company_id', $company_id );
		$criteria->compare ( 't.appointment_status', $this->appointment_status );
		$criteria->compare ( 't.title', $this->title, true );
		$criteria->compare ( 't.content', $this->content, true );
		$criteria->compare ( 't.appointment_date', $this->appointment_date, true );
		$criteria->compare ( 't.date_create', $this->date_create, true );
		$criteria->compare ( 't.date_update', $this->date_update, true );
		$criteria->compare ( 't.access_level_id', $this->access_level_id );
		if (! isset ( $_GET ['Info_sort'] ))
			$criteria->order = 'date_create DESC';
			// $criteria->with = array('company', 'user', 'infoType', 'accessLevel', 'infoComments');
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria,
				'pagination' => array (
						'pageSize' => 20 
				) 
		) );
	}
	public function searchVisitorComment($company_id) {
		$criteria = new CDbCriteria ();
		$criteria->compare ( 't.id', $this->id );
		$criteria->compare ( 't.info_type_id', 5 );
		$criteria->compare ( 't.user_id', $this->user_id );
		$criteria->compare ( 't.company_id', $company_id );
		$criteria->compare ( 't.appointment_status', $this->appointment_status );
		$criteria->compare ( 't.title', $this->title, true );
		$criteria->compare ( 't.content', $this->content, true );
		$criteria->compare ( 't.appointment_date', $this->appointment_date, true );
		$criteria->compare ( 't.date_create', $this->date_create, true );
		$criteria->compare ( 't.date_update', $this->date_update, true );
		$criteria->compare ( 't.access_level_id', $this->access_level_id );
		if (! isset ( $_GET ['Info_sort'] ))
			$criteria->order = 'date_create DESC';
			// $criteria->with = array('company', 'user', 'infoType', 'accessLevel', 'infoComments');
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria,
				'pagination' => array (
						'pageSize' => 20 
				) 
		) );
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * 
	 * @param string $className
	 *        	active record class name.
	 * @return Info the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	public function beforeSave() {
		
		if ($this->isNewRecord) {
			if (! isset ( $this->date_create ))
				$this->date_create = date ( 'Y-m-d H:i:s' );
			if (Yii::app ()->user->getState ( 'isManager' )) {
				$this->company_id = Yii::app ()->user->getState ( 'globalId' );
			}
		} else {
			$this->date_update = date ( 'Y-m-d H:i:s' );
		}
		return parent::beforeSave ();
	}
	public function afterSave() {
		// send notification to all user in company
		if ($this->info_type_id != 3 && $this->info_type_id != 4 && $this->info_type_id != 5 && $this->access_level_id != 3 && $this->access_level_id != 2) {
			$users = User::model ()->getCompanyUserDeviceIds ( $this->company_id );
			if (! is_null ( $users )) {
				$userDeviceIds = array ();
				foreach ( $users as $user ) {
					if (! is_null ( $user->device_id ) && $user->device_id != '')
						$userDeviceIds [] = $user->device_id;
				}
				SendNotification::actionPushMultiDevice ( $userDeviceIds, $this->title, $this->content, $this->info_type_id, $this->id );
			}
		}
		if (isset ( $this->receiver ) && $this->receiver->device_id != '') {
			$userDevice = $this->receiver->device_id;
			SendNotification::actionPushOneDevice ( $userDevice, $this->title, $this->content, $this->info_type_id, $this->id );
		}
		$log = new LogEvent();
		$log->company_id = $this->company_id;
		$log->info_id= $this->id;
		$log->info_title= $this->title;
		$log->user_id= $this->user_id;
		$log->user_email= $this->user->email;
		$log->date_create = date ( 'Y-m-d H:i:s' );
		if($this->isNewRecord)
			$log->event_id = 3;
		else 
			$log->event_id = 4;
		$log->insert();
		return parent::afterSave ();
	}
	public function beforeDelete() {
		$log = new LogEvent();
		$log->company_id = $this->company_id;
		$log->info_id= $this->id;
		$log->user_id= $this->user_id;
		$log->info_title= $this->title;
		$log->user_email= $this->user->email;
		$log->date_create = date ( 'Y-m-d H:i:s' );
		$log->event_id = 5;
		$log->description = $this->title;
		$log->insert();
		foreach ( $this->infoComments as $infoComment ) {
			$infoComment->delete ();
		}
		return parent::beforeDelete ();
	}
}
