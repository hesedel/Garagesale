<?php
$mysqli = new mysqli("localhost","hes_janx","janzenzarzoso","hes_garagesale_int");

// Check connection
if ($mysqli->connect_errno){
	echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}