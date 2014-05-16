<?php

class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;

	private $_identity;

	public function rules()
	{
		return array(
			array('username, password', 'required'),
			array('rememberMe', 'boolean'),
			array('password', 'authenticate'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'username'=>'Email',
			'rememberMe'=>'Remember me next time',
		);
	}

	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
			{
				switch($this->_identity->errorCode)
				{
					case 1:
						//$this->addError('username','Incorrect username.');
						//break;
					case 2:
						$this->addError('password','Incorrect username or password.');
						break;
					case 3:
						$this->addError('username','Unverified email.');
					default:
				}
			}
		}
	}

	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			Yii::app()->db->createCommand()->delete('user_password_change','user_id=:id',array(':id'=>$this->_identity->getId()));
			return true;
		}
		else
			return false;
	}

	public function getErrorCode()
	{
		if($this->_identity)
			return $this->_identity->errorCode;
		else
			return 0;
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
