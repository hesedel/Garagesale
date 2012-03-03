<?php

class ImageValidator extends CFileValidator
{
	public $minWidth;
	public $minHeight;

	protected function validateAttribute($object, $attribute)
	{
		$files=$object->$attribute;
		if(!is_array($files) || !isset($files[0]) || !$files[0] instanceof CUploadedFile)
			$files = CUploadedFile::getInstances($object, $attribute);
		if(array()===$files)
			return $this->emptyAttribute($object, $attribute);
		foreach($files as $file)
			$this->validateImage($object, $attribute, $file);
	}

	protected function validateImage($object, $attribute, $file)
	{
		$image = getimagesize($file->tempName);
		if(count($image) == 1)
		{
			$message=Yii::t('yii','The file "{file}" is not an image.');
			$this->addError($object,$attribute,$message,array('{file}'=>$file->getName()));
		}
		else if($image[0] < $this->minWidth)
		{
			$message=Yii::t('yii','The image "{file}" is not wide enough.');
			$this->addError($object,$attribute,$message,array('{file}'=>$file->getName()));
		}
		else if($image[1] < $this->minHeight)
		{
			$message=Yii::t('yii','The image "{file}" is not tall enough.');
			$this->addError($object,$attribute,$message,array('{file}'=>$file->getName()));
		}
	}

}