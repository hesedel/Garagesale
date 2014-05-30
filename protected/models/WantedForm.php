<?php

class WantedForm extends Item
{
	public function attributeLabels()
	{
		$attributeLabels = parent::attributeLabels();
		$attributeLabels['price'] = 'Price prepared to pay';
		$attributeLabels['pickup'] = 'What location can the item be collected from?';
		return $attributeLabels;
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
