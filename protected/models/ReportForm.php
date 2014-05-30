<?php

class ReportForm extends CFormModel
{
	public $reporterUserID;
	public $reportedUserID;
	public $reportType;
	public $reportDescription;
	public $verifyCode;
	public $item_id;

	public function rules()
	{
		return array(
			array('reportType, reportDescription', 'required'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements())
		);
	}

	public function attributeLabels()
	{
		return array(
			'reporterUserID'=>'Your user name',
			'reportedUserID'=>'Seller you are reporting',
			'reportType'=>'Report Type',
			'reportDescription'=>'Descrption of issue'
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
