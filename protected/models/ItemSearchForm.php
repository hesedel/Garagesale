<?php

class ItemSearchForm extends CFormModel
{
	public $keywords;

	public function rules()
	{
		return array(
			array('keywords', 'required'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'keywords'=>'Search',
		);
	}
}