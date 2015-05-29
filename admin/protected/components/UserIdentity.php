<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

	private $_id;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$username = $this->username;
		$password = $this->password;

		$data = User::model()->checkLogin($username,$password);

		if($data){

			$this->setState('id', $data->user_id);
			$this->setState('name', $data->firstname." ".$data->lastname);
			$this->setState('role', $data->role);
			
			if(($data->university) && ($data->role != "administrator")){
				$this->setState('university_id', $data->university_id);
				$this->setState('is_top_admin', false);
				$this->setState('school_logo', $data->university->logo);
				$this->setState('school_name', $data->university->university_name);
			}else{
				$this->setState('university_id', 0);
				$this->setState('is_top_admin', true);
				$this->setState('school_logo', "");
				$this->setState('school_name', "");
			}

			$this->_id = $data->user_id;

			$this->errorCode=self::ERROR_NONE;
		}else{
			$this->errorCode=self::ERROR_USERNAME_OR_PASSWORD_INVALID;
		}

		return !$this->errorCode;

	}

	// the override for getID -- this is very important for the authentication system later.
	public function getId() {
		return $this->_id;
	}

}