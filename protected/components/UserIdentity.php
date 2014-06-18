<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        /* $users=array(
          // username => password
          'demo'=>'demo',
          'admin'=>'admin',
          );
          if(!isset($users[$this->username]))
          $this->errorCode=self::ERROR_USERNAME_INVALID;
          elseif($users[$this->username]!==$this->password)
          $this->errorCode=self::ERROR_PASSWORD_INVALID;
          else
          $this->errorCode=self::ERROR_NONE;
          return !$this->errorCode; */
        $record = User::model()->findByAttributes(array("email" => $this->username));
        if ($record === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif ($record->password !== md5($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } elseif ($record->user_level_id < 2) {
        	$this->errorCode = self::ERROR_USERNAME_INVALID;
        } else {
            $this->_id = $record->id;
            $this->username = $record->email;
            $this->errorCode = self::ERROR_NONE;
            $this->setState('user_id', $record->id);
            $this->setState('user_name', $record->user_name);
            $this->setState('company_id', $record->company_id);
            $this->setState('rss_url', $record->company->rss_url);
            if($record->user_level_id ==3) {
            	Yii::app()->user->setState("isAdmin", true);
            } else if($record->user_level_id ==2) {
            	Yii::app()->user->setState("isManager", true);
            	Yii::app()->user->setState("globalName", $record->company->name);
            	Yii::app()->user->setState("globalId", $record->company->id);
            }
        }
        return !$this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }

//	public function authenticate()
//	{
//			$users=array(
//						// username => password
//						'demo'=>'demo',
//						'admin'=>'admin',
//					);
//			if(!isset($users[$this->username]))
//					$this->errorCode=self::ERROR_USERNAME_INVALID;
//			elseif($users[$this->username]!==$this->password)
//				$this->errorCode=self::ERROR_PASSWORD_INVALID;
//			else
//					$this->errorCode=self::ERROR_NONE;
//			return !$this->errorCode; 
//	}
}

// 	private $_id;
// 	/**
// 	 * Authenticates a user.
// 	 * @return boolean whether authentication succeeds.
// 	 */
// 	public function authenticate()
// 	{
// 		$username = strtolower($this->username);
// 		// from database... change to suit your authentication criteria
// 		// -- Nope, I wont include mine --
// 		$user = User::model()->find('LOWER(email)=?', array($username));
// 		if($user===null)
// 			$this->errorCode=self::ERROR_USERNAME_INVALID;
// 		else if($user->password !== $this->password)
// 			$this->errorCode = self::ERROR_PASSWORD_INVALID;
// 		else{
// 			// successful login
// 			$this->_id = $user->id;
// 			$this->username = $user->email;
// 			$this->errorCode = self::ERROR_NONE;
// 		}
// 		return $this->errorCode == self::ERROR_NONE;
// 	}
// 	public function getId()
// 	{
// 		return $this->_id;
// 	}
