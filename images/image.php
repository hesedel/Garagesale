<?php
$params = require_once('../protected/config/local.php');

mysql_connect('localhost', $params['db.username'], $params['db.password']);
mysql_select_db('garagesale');

$image = mysql_fetch_array(mysql_query('SELECT type, data FROM '.$_GET['table'].' WHERE id='.$_GET['id']));

header('Content-Type: image/'.$image['type']);
echo $image['data'];