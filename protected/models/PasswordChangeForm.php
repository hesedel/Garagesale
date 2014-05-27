<?php

class PasswordChangeForm extends CFormModel
{
	public $password_repeat;

	public function tableName()
	{
		return 'user';
	}

	public function rules()
	{
		return array(
			array('password, password_repeat', 'required'),
			array('password, password_repeat', 'length', 'min'=>8, 'max'=>32),
			array('password_repeat', 'compare', 'compareAttribute'=>'password'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'password' => 'Password',
			'password_repeat' => 'Repeat Password',
		);
	}

	protected function beforeSave()
	{
		$this->password = md5(md5($this->password).Yii::app()->params['salt']);
		return true;
	}

	public static function model($className=__CLASS__)
	{
		//return parent::model($className);
	}
}
