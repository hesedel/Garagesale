<?php
$params=require(dirname(__FILE__).'/../protected/config/params.php');

$mysqli = new mysqli($params['db.host'],$params['db.username'],$params['db.password'],$params['db.name']);

// Check connection
if ($mysqli->connect_errno){
	echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}