<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property integer $company_id
 * @property integer $user_level_id
 * @property integer $is_actived
 * @property string $email
 * @property string $password
 * @property string $user_name
 * @property string $contact_phone
 * @property string $register_date
 * @property integer $device_os_id
 * @property string $device_id
 * @property integer $notify
 * @property string $token
 * @property string $token_expired_date
 *
 * The followings are the available model relations:
 * @property ChangeLog[] $changeLogs
 * @property Info[] $infos
 * @property InfoComment[] $infoComments
 * @property LogEvent[] $logEvents
 * @property DeviceOs $deviceOs
 * @property Company $company
 * @property UserLevel $userLevel
 */
class User extends CActiveRecord {
	// add new attributes to model
	public function getUserLevelName() {
		return $this->userLevel->name;
	}
	public function getDeviceOsName() {
		if (isset ( $this->deviceOs ))
			return $this->deviceOs->name . " " . $this->deviceOs->device_type . " " . $this->deviceOs->version;
	}
	public function getIsActived() {
		if ($this->is_actived > 0) {
			return 'Yes';
		}
		return 'No';
	}
	public function getCompanyName() {
		if (isset ( $this->company->name ))
			return $this->company->name;
	}
	public function getNotifyName() {
		if ($this->notify > 0) {
			return 'Yes';
		}
		return 'No';
	}
	public function getUserRegisterTime() {
		return strtotime ( $this->register_date ) * 1000;
	}
	public function getAttributes($names = true) {
		$attrs = parent::getAttributes ( $names );
		$attrs ['userLevelName'] = $this->getUserLevelName ();
		$attrs ['deviceOsName'] = $this->getDeviceOsName ();
		$attrs ['isActived'] = $this->getIsActived ();
		$attrs ['companyName'] = $this->getCompanyName ();
		$attrs ['notifyName'] = $this->getNotifyName ();
		$attrs ['userRegisterTime'] = $this->getNotifyName ();
		
		return $attrs;
	}
	
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'user';
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
						'email, password, user_name',
						'required' 
				),
				array (
						'company_id, user_level_id, is_actived, device_os_id, notify',
						'numerical',
						'integerOnly' => true 
				),
				array (
						'user_name, contact_phone, register_date, device_id, token, token_expired_date',
						'safe' 
				),
				// The following rule is used by search().
				// @todo Please remove those attributes that should not be searched.
				array (
						'id, company_id, user_level_id, is_actived, email, password, user_name, contact_phone, register_date, device_os_id, device_id, notify, token, token_expired_date',
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
				'changeLogs' => array (
						self::HAS_MANY,
						'ChangeLog',
						'user_id' 
				),
				'infos' => array (
						self::HAS_MANY,
						'Info',
						'user_id' 
				),
				'infoComments' => array (
						self::HAS_MANY,
						'InfoComment',
						'user_id' 
				),
				'logEvents' => array (
						self::HAS_MANY,
						'LogEvent',
						'user_id' 
				),
				'deviceOs' => array (
						self::BELONGS_TO,
						'DeviceOs',
						'device_os_id' 
				),
				'company' => array (
						self::BELONGS_TO,
						'Company',
						'company_id' 
				),
				'userLevel' => array (
						self::BELONGS_TO,
						'UserLevel',
						'user_level_id' 
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
				'company_id' => Yii::t ( 'strings', 'Company' ),
				'user_level_id' => Yii::t ( 'strings', 'User Level' ),
				'is_actived' => Yii::t ( 'strings', 'Active Status' ),
				'email' => 'Email',
				'password' => Yii::t ( 'strings', 'Password' ),
				'user_name' => Yii::t ( 'strings', 'User Name' ),
				'contact_phone' => Yii::t ( 'strings', 'Contact Phone' ),
				'register_date' => Yii::t ( 'strings', 'Register Date' ),
				'device_os_id' => Yii::t ( 'strings', 'Device Os' ),
				'device_id' => Yii::t ( 'strings', 'Device Id' ),
				'notify' => Yii::t ( 'strings', 'Notify' ),
				'token' => 'Token',
				'token_expired_date' => Yii::t ( 'strings', 'Token Expired Date' ) 
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
		$criteria->compare ( 'company_id', $this->company_id );
		$criteria->compare ( 'user_level_id', $this->user_level_id );
		$criteria->compare ( 'is_actived', $this->is_actived );
		$criteria->compare ( 'email', $this->email, true );
		$criteria->compare ( 'password', $this->password, true );
		$criteria->compare ( 'user_name', $this->user_name, true );
		$criteria->compare ( 'contact_phone', $this->contact_phone, true );
		$criteria->compare ( 'register_date', $this->register_date, true );
		$criteria->compare ( 'device_os_id', $this->device_os_id );
		$criteria->compare ( 'device_id', $this->device_id, true );
		$criteria->compare ( 'notify', $this->notify );
		$criteria->compare ( 'token', $this->token, true );
		$criteria->compare ( 'token_expired_date', $this->token_expired_date, true );
		if (! isset ( $_GET ['User_sort'] ))
			$criteria->order = 't.register_date DESC';
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
	 * @return User the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	public function beforeSave() {
		
		if (! isset ( $this->user_name ))
			$this->user_name = "";
		if ($this->isNewRecord) {
			if (! isset ( $this->device_os_id )) {
				$this->device_os_id = 1;
			}
			$this->token = $this->generateToken ( $this->email, $this->device_id );
			
			$now = date ( 'Y-m-d H:i:s' );
			$tomorrow = strtotime ( "+1 day", strtotime ( $now ) );
			$this->token_expired_date = date ( 'Y-m-d H:i:s', $tomorrow );
			
			$this->password = md5 ( $this->password );
			$this->register_date = date ( 'Y-m-d H:i:s' );
			if (Yii::app ()->user->getState ( 'isManager' )) {
				$this->company_id = Yii::app ()->user->getState ( 'globalId' );
			}
		} else {
			if (isset ( $this->password ) && $this->password != '') {
				$user = $this->find ( 't.id=:id AND t.password=:password', array (
						':id' => $this->id,
						':password' => $this->password 
				) );
				if (is_null ( $user )) {
					$this->password = md5 ( $this->password );
				}
			}
		}
		return parent::beforeSave ();
	}
	public function afterSave() {
		$log = new LogEvent();
		$log->company_id = $this->info->company_id;
		$log->user_id= $this->id;
		$log->user_email= $this->email;
		$log->date_create = date ( 'Y-m-d H:i:s' );
		if($this->isNewRecord)
			$log->event_id = 3;
		else 
			$log->event_id = 4;
		$log->insert();
		return parent::afterSave ();
	}
	public function getCompanyUserDeviceIds($company_id = 1) {
		$criteria = new CDbCriteria ();
		$criteria->select = array (
				'device_id' 
		);
		$criteria->condition = 't.company_id=:company_id AND t.is_actived=:is_actived AND t.notify=:notify';
		$criteria->params = array (
				':company_id' => $company_id,
				':is_actived' => 1,
				':notify' => 1 
		);
		return $this->findAll ( $criteria );
	}
	public function getCompanyUser($company_id = 1) {
		$criteria = new CDbCriteria ();
		$criteria->condition = 't.company_id=:company_id AND t.is_actived=:is_actived AND t.user_level_id=:user_level_id';
		$criteria->params = array (
				':company_id' => $company_id,
				':is_actived' => 1, 
				':user_level_id' => 1 ,
		);
		return $this->findAll ( $criteria );
	}
	public function getCompanyManager($company_id = 1) {
		$criteria = new CDbCriteria ();
		$criteria->condition = 't.company_id=:company_id AND t.is_actived=:is_actived AND t.user_level_id=:user_level_id';
		$criteria->params = array (
				':company_id' => $company_id,
				':is_actived' => 1 ,
				':user_level_id' => 2 ,
		);
		return $this->findAll ( $criteria );
	}
	public function getCompanyUsers() {
		$criteria = new CDbCriteria ();
		
		$criteria->compare ( 'id', $this->id );
		$criteria->compare ( 'company_id', Yii::app ()->user->getState ( 'globalId' ) );
		$criteria->compare ( 'user_level_id', 1 );
		$criteria->compare ( 'is_actived', $this->is_actived );
		$criteria->compare ( 'email', $this->email, true );
		$criteria->compare ( 'password', $this->password, true );
		$criteria->compare ( 'user_name', $this->user_name, true );
		$criteria->compare ( 'contact_phone', $this->contact_phone, true );
		$criteria->compare ( 'register_date', $this->register_date, true );
		$criteria->compare ( 'device_os_id', $this->device_os_id );
		$criteria->compare ( 'device_id', $this->device_id, true );
		$criteria->compare ( 'notify', $this->notify );
		$criteria->compare ( 'token', $this->token, true );
		$criteria->compare ( 'token_expired_date', $this->token_expired_date, true );
		if (! isset ( $_GET ['User_sort'] ))
			$criteria->order = 't.register_date DESC';
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria,
				'pagination' => array (
						'pageSize' => 20 
				) 
		) );
	}
	public function getCompanyManagers(){
		$criteria=new CDbCriteria;
	
		$criteria->compare('id',$this->id);
		$criteria->compare('hospital_id',Yii::app()->user->getState('globalId'));
		$criteria->compare('user_level_id',2);
		$criteria->compare('is_actived',$this->is_actived);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('contact_phone',$this->contact_phone,true);
		$criteria->compare('register_date',$this->register_date,true);
		$criteria->compare('device_os_id',$this->device_os_id);
		$criteria->compare('device_id',$this->device_id,true);
		$criteria->compare('notify',$this->notify);
		$criteria->compare('token',$this->token,true);
		$criteria->compare('token_expired_date',$this->token_expired_date,true);
		if(!isset($_GET['User_sort']))
			$criteria->order = 'register_date DESC';
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination' => array(
						'pageSize' => 20,
				),
		));
	}
	public function getArrayCompanyUsers() {
		$criteria = new CDbCriteria ();
		
		$criteria->compare ( 'company_id', Yii::app ()->user->getState ( 'globalId' ) );
		$users = $this->findAll ( $criteria );
		$arr = array ();
		$arr ['0'] = '- All users -';
		$arr ['-1'] = '- Managers only -';
		$arr ['-2'] = '- Users only -';
		foreach ( $users as $user ) {
			$arr [$user->id] = $user->email;
		}
		return $arr;
	}
	public function beforeDelete() {
		// $criteria = new CDbCriteria();
		// $criteria->condition = 't.user_id=:user_id';
		// $criteria->params = array(':=user_id'=>$this->id);
		// $infos = Info::model()->findAll($criteria);
		foreach ( $this->infoComments as $infoComment ) {
			$infoComment->delete ();
		}
		foreach ( $this->infos as $info ) {
			$info->delete ();
		}
		$log = new LogEvent();
		$log->company_id = $this->company_id;
		$log->user_id= $this->id;
		$log->user_email= $this->email;
		$log->date_create = date ( 'Y-m-d H:i:s' );
		$log->event_id = 5;
		$log->description = $this->user_name.' - Level: '.$this->userLevel->name;
		$log->insert();
		return parent::beforeDelete ();
	}
	
	/**
	 * generate a token for authenticating between server and user
	 * 
	 * @param string $email
	 *        	user's email
	 * @param string $device_id
	 *        	user's device id
	 * @return string the token for authenticating
	 */
	public function generateToken($email = '', $device_id = '') {
		return md5 ( uniqid ( $email . $device_id, true ) );
	}
}
