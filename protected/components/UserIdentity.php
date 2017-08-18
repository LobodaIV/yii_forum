<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;

	public function authenticate() {

		$user = User::model()->findByAttributes(array('username' => $this->username));
		if ($user === null) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
			return $this->errorCode;
			return false;
		} else {
			if (!$user->validatePassword($this->password)) {
			//if ($user->password !== $this->password) {
				$this->errorCode = self::ERROR_PASSWORD_INVALID;
  				return false;
			} else {
				$this->_id = $user->primaryKey;
				$this->setState('role', $user->role);
				$this->errorCode = self::ERROR_NONE;
  				return true;
			}
		}
	}

	public function getId() {
		return $this->_id;
	}

	public function getErrorCode() {
		return $this->errorCode;	
	}

}