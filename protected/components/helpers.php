<?php

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