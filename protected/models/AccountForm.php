<?php

class AccountForm extends User
{
	public $password_old;
	public $password_repeat;

	public function rules()
	{
		$rules = parent::rules();
		//$rules[] = array('email_repeat, password, password_repeat', 'required');
		$rules[] = array('password_old', 'authenticatePassword');
		$rules[] = array('password_repeat', 'length', 'min'=>8, 'max'=>32);
		$rules[] = array('password_repeat', 'compare', 'compareAttribute'=>'password');
		return $rules;
	}

	public function attributeLabels()
	{
		$attributeLabels = parent::attributeLabels();
		$attributeLabels['password_old'] = 'Old Password';
		$attributeLabels['password'] = 'New Password';
		$attributeLabels['password_repeat'] = 'Repeat New Password';
		return $attributeLabels;
	}

	public function authenticatePassword($attribute) {
		if(strlen($this->password) != 0)
		{
			if(strlen($this->password_old) == 0)
				$this->addError($attribute, $this->getAttributeLabel($attribute).' is required for password change.');
			if(md5(md5($this->password_old).Yii::app()->params['salt']) !== $this->password_old())
				$this->addError($attribute, 'Incorrect password.');
		}
	}

	private function password_old()
	{
		return Yii::app()->db->createCommand()
			->select('password')
			->from('user')
			->where('id=:id', array(':id'=>$this->id))
			->queryScalar();
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
