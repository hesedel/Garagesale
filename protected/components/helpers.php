<?php

function db_image($table, $id, $options = array()) {
	$defaults = array(
		'unlink'=>false,
	);
	$options = array_merge($defaults, $options);

	$image = Yii::app()->db->createCommand()
		->select('type, data')
		->from($table)
		->where('id=:id', array(':id'=>$id))
		->queryRow();
	if($image) {
		$file = '/images/uploads/cache/'.md5($table.$id).'.'.$image['type'];
		if(!$options['unlink']) {
			if(!file_exists(Yii::getPathOfAlias('webroot').$file))
				file_put_contents(Yii::getPathOfAlias('webroot').$file, $image['data']);
		} else if(file_exists(Yii::getPathOfAlias('webroot').$file))
			unlink(Yii::getPathOfAlias('webroot').$file);
		return $file;
	} else
		return false;
}

function time_local($time, $options = array())
{
	$defaults = array(
		'timeZone'=>Yii::app()->params['timeZone'],
		'format'=>false,
		'offset'=>0,
	);
	$options = array_merge($defaults, $options);

	$serverTime = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone(date_default_timezone_get()));
	$targetTime = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone($options['timeZone']));
	$timeZoneOffset = $targetTime->getOffset() - $serverTime->getOffset();
	$dateTime = new DateTime($time);
	$unix = $dateTime->format('U') + $timeZoneOffset + $options['offset'];
	if(!$options['format'])
		return Yii::app()->dateFormatter->formatDateTime($unix);
	else
		return date($options['format'], $unix);
}