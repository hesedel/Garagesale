<?php

class ItemContactForm extends CFormModel
{
	public $name;
	public $email;
	public $body;
	//public $verifyCode;

	public function rules()
	{
		return array(
			array('name, email, body', 'required'),
			array('email', 'email'),
			//array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	public function attributeLabels()
	{
		return array(
			//'verifyCode'=>'Verification Code',
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
