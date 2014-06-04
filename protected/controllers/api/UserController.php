<?php
class UserController extends Controller {
	// Members
	/**
	 * Key which has to be in HTTP USERNAME and PASSWORD headers
	 */
	private $modelName = 'User';
	/**
	 * Default response format
	 * either 'json' or 'xml'
	 */
	private $with = array ();
	/**
	 *
	 * @return array action filters
	 */
	public function filters() {
		return array ();
	}
	
	/**
	 * get all User from database
	 */
	public function actionGetAll() {
		// Get the respective model instance
		$criteria = new CDbCriteria ();
		
		if (isset ( $_GET [Params::param_Offset] )) {
			$criteria->offset = $_GET [Params::param_Offset];
		}
		
		if (isset ( $_GET [Params::param_Limit] )) {
			$criteria->limit = $_GET [Params::param_Limit];
		}
		
		if (isset ( $_GET [Params::param_Order] )) {
			$criteria->order = $_GET [Params::param_Order];
		}
		
		$criteria->with = array (
				'company',
				'userLevel',
				'deviceOs' 
		);
		$models = User::model ()->findAll ( $criteria );
		
		// Did we get some results?
		if (empty ( $models )) {
			// No
			Response::NoRecord($this->modelName);
		} else {
			Response::Success($this->modelName, $models);
		}
	}
	
	/**
	 * get all user belong to any individual hospital
	 * param: hospital_id
	 */
	public function actionGetByCompany() {
		// Get the respective model instance
		$criteria = new CDbCriteria ();
		
		if (isset ( $_GET [Params::param_Offset] )) {
			$criteria->offset = $_GET [Params::param_Offset];
		}
		
		if (isset ( $_GET [Params::param_Limit] )) {
			$criteria->limit = $_GET [Params::param_Limit];
		}
		
		if (isset ( $_GET [Params::param_Order] )) {
			$criteria->order = $_GET [Params::param_Order];
		}
		
		if (!isset ( $_GET [Params::param_Company_Id] )) {
			Response::MissingParam(Params::param_Hospital_Id);
		}
		$criteria->condition = 'company_id=:company_id';
		$criteria->params = array (
				':company_id' => $_GET [Params::param_Company_Id]
		);
		$criteria->with = array (
				'userLevel',
				'deviceOs'
		);
		$models = User::model ()->findAll ( $criteria );
			
		// Did we get some results?
		if (empty ( $models )) {
			// No
			Response::NoRecord( $this->modelName );
		} else {
			// Prepare response
			Response::Success($this->modelName, $models);
		}
	}
	
	/**
	 * view user's info detail
	 * param: id
	 */
	public function actionView() {
		// Check if id was submitted via GET
		if (! isset ( $_GET [Params::param_Id] )) {
			Response::MissingParam( Params::param_Id );
		}
		$criteria = new CDbCriteria ();
		$criteria->with = array (
				'company',
				'userLevel',
				'deviceOs' 
		);
		$model = User::model ()->findByPk ( $_GET [Params::param_Id], $criteria );
		// Did we find the requested model? If not, raise an error
		if (is_null ( $model )) {
			Response::NoRecord( $this->modelName );
		} else {
			Response::Success( $this->modelName, $model );
		}
	}
	
	/**
	 * create an user and save on db
	 * params: .
	 * ..
	 */
	public function actionRegister() {
		if (! isset ( $_POST [Params::param_Company_Id] )) {
			Response::MissingParam(Params::param_Company_Id);
		}
		if (! isset ( $_POST [Params::param_Email] )) {
			Response::MissingParam(Params::param_Email);
		}
		if (! isset ( $_POST [Params::param_Password] )) {
			Response::MissingParam(Params::param_Password);
		}
		if (! isset ( $_POST [Params::param_User_Name] )) {
			Response::MissingParam(Params::param_User_Name);
		}
		if (! isset ( $_POST [Params::param_Contact_Phone] )) {
			Response::MissingParam(Params::param_Contact_Phone);
		}
		if (! isset ( $_POST [Params::param_Device_Os_Id] )) {
			Response::MissingParam(Params::param_Device_Os_Id);
		}
		if (! isset ( $_POST [Params::param_Device_Id] )) {
			Response::MissingParam(Params::param_Device_Id);
		}
		
		//if email existed, let user chose another email or login with current email
		if(!is_null($this->checkEmailExisted($_POST [Params::param_Email], $_POST [Params::param_Hospital_Id]))) {
			$message = "Email existed. Please use another email or login with current email.";
			Response::Failed($message);
		}
		$user = new User ();
		$user->company_id = $_POST [Params::param_Company_Id];
		$user->user_level_id = 1;
		$user->email = $_POST [Params::param_Email];
		$user->password = md5($_POST [Params::param_Password]);
		$user->user_name = $_POST [Params::param_User_Name];
		$user->contact_phone = $_POST [Params::param_Contact_Phone];
		$user->device_os_id = $_POST [Params::param_Device_Os_Id];
		$user->device_id = $_POST [Params::param_Device_Id];
		$user->token = $this->generateToken ( $_POST [Params::param_Email], $_POST [Params::param_Device_Id] );

		$now = date('Y-m-d H:i:s');
		$tomorrow = strtotime("+1 day", strtotime($now));
		$user->token_expired_date = date('Y-m-d H:i:s', $tomorrow);
		//echo date("Y-m-d", $date);
		if ($user->insert ()) {
			$data = array('token' => $user->token );
			Response::Success($this->modelName, $data);
		} else {
			$message = 'Register failed.';
			Response::Failed($message);
		}
	}
	
	/*
	 * login user to server, maybe update device token id return a token to user for authenticating
	 */
	public function actionLogin() {
		if (! isset ( $_POST [Params::param_Company_Id] )) {
			Response::MissingParam(Params::param_Company_Id);
		}
		if (! isset ( $_POST [Params::param_Email] )) {
			Response::MissingParam(Params::param_Email);
		}
		if (! isset ( $_POST [Params::param_Password] )) {
			Response::MissingParam(Params::param_Password);
		}
		
		$password = md5($_POST[Params::param_Password]);
		
		// check email and company id existed
		$email = $_POST [Params::param_Email];
		$company_id = $_POST [Params::param_Company_Id];
		$device_id = '';
		if (isset ( $_POST [Params::param_Device_Id] )) {
			$device_id = $_POST [Params::param_Device_Id];
		}
		$user = $this->checkEmailExisted ( $email, $company_id );
		if (!is_null($user) && $user->is_actived === 1 && $password===$user->password) {
			// email existed, password correct, login successfully
			// check if device id is not existed, replace with the new
			if ($device_id!=='' && ! $this->checkDeviceIdExisted ( $email, $company_id, $device_id )) {
				// new device id, replace current device id in database
				User::model ()->updateByPk ( $user->id, array (
						'device_id' => $device_id 
				) );
			}
			$now = date('Y-m-d H:i:s');
			$tomorrow = strtotime("+1 day", strtotime($now));
			$token_expired_date = date('Y-m-d H:i:s', $tomorrow);
			
			$token = $this->generateToken ( $user->email, $user->device_id );
			User::model ()->updateByPk ( $user->id, array (
					'token' => $token, 
					'token_expired_date' =>$token_expired_date
			) );
			
			$data = array('token' => $token);
			Response::Success($this->modelName, $data);
		} else {
			$message = 'Login failed, incorrect email/password or your account had been deactived by administrator.';
			Response::Failed($message);
		}
	}
	public function actionUpdate() {
	}
	public function actionDelete() {
	}
	
	/**
	 * generate a token for authenticating between server and user
	 * @param string $email user's email
	 * @param string $device_id user's device id
	 * @return string the token for authenticating
	 */
	public function generateToken($email='', $device_id='') {
		return md5 ( uniqid ( $email . $device_id, true ) );
	}
	
	/**
	 * Check if email existed or not 
	 * @param unknown $email user's email
	 * @param unknown $hospital_id user's hospital id
	 * @return ActiveRecord an user object if existed, null if didn't existed
	 */
	public function checkEmailExisted($email, $company_id) {
		$criteria = new CDbCriteria ();
		$criteria->condition = 'email=:email AND company_id=:company_id';
		$criteria->params = array (
				':email' => $email,
				':company_id' => $company_id 
		);
		$result = User::model ()->find ( $criteria );
		return $result;
	}
	
	/**
	 * Check if device id is existed or not 
	 * if not existed or different, update current to new device id
	 * @param string $email user's email
	 * @param number $hospital_id user's hospital id
	 * @param string $device_id user's device id
	 * @return boolean TRUE if device id existed, otherwise FALSE
	 */
	public function checkDeviceIdExisted($email='', $company_id=0, $device_id='') {
		$criteria = new CDbCriteria ();
		$criteria->condition = 'email=:email AND company_id=:company_id AND device_id=:device_id';
		$criteria->params = array (
				':email' => $email,
				':company_id' => $company_id,
				':device_id' => $device_id 
		);
		$result = User::model ()->find ( $criteria );
		if (is_null($result)) {
			return FALSE;
		} else
			return TRUE;
	}
}
?>
