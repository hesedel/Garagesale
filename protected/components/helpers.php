<?php

function localTime($time, $offset = 0)
{
	$serverTime = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone(date_default_timezone_get()));
	$targetTime = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone(Yii::app()->params['timeZone']));
	$timeZoneOffset = $targetTime->getOffset() - $serverTime->getOffset();
	$dateTime = new DateTime($time);
	return Yii::app()->dateFormatter->formatDateTime($dateTime->format('U') + $timeZoneOffset + $offset);
}