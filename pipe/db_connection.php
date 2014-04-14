<?php
$conn = mysqli_connect("garagesale.ph","hes_janx","janzenzarzoso","hes_garagesale_int");

// Check connection
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}