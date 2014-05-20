<?php

class WantedForm extends CFormModel
{
	public $title;
	public $description;
	public $price;
	public $freebieCheckbox;
	public $itemCondition;
	public $collectionLocation;
	public $verifyCode;

	public function rules()
	{
		return array(
			array('title, description, price, itemCondition, collectionLocation', 'required'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements())
		);
	}

	public function attributeLabels()
	{
		return array(
			'title'=>'Title',
			'description'=>'Descrption',
			'price'=>'Price prepared to pay',
			'freebieCheckbox'=>'Free!',
			'itemCondition'=>'Item Condition',
			'collectionLocation'=>'What location can the item be collected form?'
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
