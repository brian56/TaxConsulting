<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $company_id
 * @property string $user_level_id
 * @property integer $is_actived
 * @property string $email
 * @property string $password
 * @property string $user_name
 * @property string $contact_phone
 * @property string $register_date
 * @property string $device_os_id
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
 * @property Company $company
 * @property DeviceOs $deviceOs
 * @property UserLevel $userLevel
 */
class User extends CActiveRecord
{
//add new attributes to model
	public function getUserLevelName(){
		return $this->userLevel->name;
	}
	
	public function getDeviceOsName(){
		return $this->deviceOs->name." ".$this->deviceOs->device_type." ".$this->deviceOs->version;
	}

	public function getIsActived(){
		if($this->is_actived>0) {
			return 'Yes';
		}
		return 'No';
	}
	
	public function getCompanyName(){
		return $this->company->name;
	}
	
	public function getNotifyName(){
			if($this->notify>0) {
			return 'Yes';
		}
		return 'No';
	}
	
	public function getAttributes($names = true) {
		$attrs = parent::getAttributes($names);
		$attrs['userLevelName'] = $this->getUserLevelName();
		$attrs['deviceOsName'] = $this->getDeviceOsName();
		$attrs['isActived'] = $this->getIsActived();
		$attrs['companyName'] = $this->getCompanyName();
		$attrs['notifyName'] = $this->getNotifyName();
	
		return $attrs;
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, user_level_id, email, password, user_name, contact_phone, register_date, device_os_id, device_id, token, token_expired_date', 'required'),
			array('is_actived, notify', 'numerical', 'integerOnly'=>true),
			array('company_id, user_level_id', 'length', 'max'=>11),
			array('password, user_name', 'length', 'max'=>256),
			array('contact_phone', 'length', 'max'=>50),
			array('device_os_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, company_id, user_level_id, is_actived, email, password, user_name, contact_phone, register_date, device_os_id, device_id, notify, token, token_expired_date', 'safe', 'on'=>'search'),
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
			'changeLogs' => array(self::HAS_MANY, 'ChangeLog', 'user_id'),
			'infos' => array(self::HAS_MANY, 'Info', 'user_id'),
			'infoComments' => array(self::HAS_MANY, 'InfoComment', 'user_id'),
			'logEvents' => array(self::HAS_MANY, 'LogEvent', 'user_id'),
			'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
			'deviceOs' => array(self::BELONGS_TO, 'DeviceOs', 'device_os_id'),
			'userLevel' => array(self::BELONGS_TO, 'UserLevel', 'user_level_id'),
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
			'user_level_id' => 'User Level',
			'is_actived' => 'Actived',
			'email' => 'Email',
			'password' => 'Password',
			'user_name' => 'User Name',
			'contact_phone' => 'Contact Phone',
			'register_date' => 'Register Date',
			'device_os_id' => 'Device Os',
			'device_id' => 'Device',
			'notify' => 'Notify',
			'token' => 'Token',
			'token_expired_date' => 'Token Expired Date',
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
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('user_level_id',$this->user_level_id,true);
		$criteria->compare('is_actived',$this->is_actived);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('contact_phone',$this->contact_phone,true);
		$criteria->compare('register_date',$this->register_date,true);
		$criteria->compare('device_os_id',$this->device_os_id,true);
		$criteria->compare('device_id',$this->device_id,true);
		$criteria->compare('notify',$this->notify);
		$criteria->compare('token',$this->token,true);
		$criteria->compare('token_expired_date',$this->token_expired_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave()
	{
		if($this->isNewRecord)
		{
			$this->register_date= date('Y-m-d H:i:s');
			if(Yii::app()->user->getState('isManager')) {
				$this->company_id = Yii::app()->user->getState('companyId');
			}
		}
		return parent::beforeSave();
	}
	
	public function getCompanyUserDeviceIds($company_id=1){
		$criteria = new CDbCriteria();
		$criteria->select = array('device_id');
		$criteria->condition = 't.company_id=:company_id AND t.is_actived=:is_actived';
		$criteria->params = array(':company_id'=>$company_id, ':is_actived'=>1);
		return $this->findAll($criteria);
	}
}
