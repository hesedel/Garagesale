<?php

class RegisterForm extends User
{
	public $email_repeat;
	public $password_repeat;
	public $verifyCode;
	public $agree;

	public function rules()
	{
		$rules = parent::rules();
		//$rules[] = array('email_repeat, password, password_repeat', 'required');
		$rules[] = array('password', 'required');
		$rules[] = array('agree', 'required', 'message'=>'You must agree to '.Yii::app()->name.'\'s Terms and Privacy Policy.');
		//$rules[] = array('email_repeat', 'length', 'max'=>64);
		//$rules[] = array('email_repeat', 'compare', 'compareAttribute'=>'email');
		//$rules[] = array('password_repeat', 'length', 'min'=>8, 'max'=>32);
		//$rules[] = array('password_repeat', 'compare', 'compareAttribute'=>'password');
		$rules[] = array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements());
		return $rules;
	}

	public function attributeLabels()
	{
		$attributeLabels = parent::attributeLabels();
		//$attributeLabels['email_repeat'] = 'Repeat Email';
		//$attributeLabels['password_repeat'] = 'Repeat Password';
		$attributeLabels['verifyCode'] = 'Verification Code';
		$attributeLabels['agree'] = 'I agree to '.Yii::app()->name.'\'s '.CHtml::link('Terms',array('/site/page','view'=>'terms')).' and '.CHtml::link('Privacy Policy',array('/site/page','view'=>'policy')).'.';
		return $attributeLabels;
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
