<?php

class BadWord extends CValidator
{
	private $badWords=array(
		'asshole',
		'bitch',
		'dickhead',
		'fuck',
		'idiot',
		'shit',
	); 

	protected function validateAttribute($object,$attribute)
	{
		$words=explode(' ',$object->$attribute);
		foreach($words as $word)
		{
			$word=strtolower($word);
			if(in_array($word, $this->badWords))
			{
				$this->addError($object, $attribute, 'Please use a more suitable word other than "'.$word.'".');
			}
		}
	}

}
