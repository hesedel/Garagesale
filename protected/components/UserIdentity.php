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
		$user = Yii::app()->db->createCommand()
			->select('id, password, name_first, verified')
			->from('user')
			->where('id=:id or email=:id', array(':id'=>$this->username))
			->queryRow();
		if(!$user)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(md5(md5($this->password).Yii::app()->params['salt'])!==$user['password'])
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else if($user['verified']==0)
			$this->errorCode=3;
		else
		{
			$this->_id = $user['id'];
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

	public function getId() {
		return $this->_id;
	}
}