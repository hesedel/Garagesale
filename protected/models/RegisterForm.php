<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $created
 * @property string $updated
 * @property string $password
 * @property integer $role
 * @property string $name_first
 * @property string $name_last
 *
 * The followings are the available model relations:
 * @property Item[] $items
 */
class RegisterForm extends User
{
	public $email_repeat;
	public $password_repeat;
	public $verifyCode;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		$rules = parent::rules();
		$rules[] = array('email_repeat, password, password_repeat', 'required');
		$rules[] = array('email_repeat', 'length', 'max'=>64);
		$rules[] = array('email_repeat', 'compare', 'compareAttribute'=>'email');
		$rules[] = array('password_repeat', 'length', 'min'=>8, 'max'=>32);
		$rules[] = array('password_repeat', 'compare', 'compareAttribute'=>'password');
		$rules[] = array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements());
		return $rules;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$attributeLabels = parent::attributeLabels();
		$attributeLabels['email_repeat'] = 'Repeat Email';
		$attributeLabels['password_repeat'] = 'Repeat Password';
		$attributeLabels['verifyCode'] = 'Verification Code';
		return $attributeLabels;
	}
}