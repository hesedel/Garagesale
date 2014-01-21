<?php
$protocol = 'HTTP/1.0';
if($_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1')
	$protocol = 'HTTP/1.1';
header($protocol . ' 503 Service Unavailable', true, 503);
header('Retry-After: 3600'); // 1 hour

$this->pageTitle = Yii::app()->name . ', Coming Soon';

$this->layout = '503';
?>

<h2>Coming Soon</h2>

<p><?php echo Yii::app()->name; ?> ...</p>
