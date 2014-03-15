<?php
$cpuser = ''; // cPanel username
$cppass = ''; // cPanel password
$cpdomain = ''; // cPanel domain or IP
$cpskin = ''; // cPanel skin (x|x2|x3)

$key = ''; // security

$euser = isset($_REQUEST['user']) ? $_REQUEST['user'] : '';
$edomain = isset($_REQUEST['domain']) ? $_REQUEST['domain'] : $cpdomain;

if(isset($_REQUEST['key']) && $_REQUEST['key'] === $key && strlen($euser) > 0) {
	switch($_REQUEST['action']) {
		case 'create':
			$epass = isset($_REQUEST['pass']) ? $_REQUEST['pass'] : 'password';
			$equota = isset($_REQUEST['quota']) ? $_REQUEST['quota'] : 10;
			$f = fopen("http://$cpuser:$cppass@$cpdomain:2082/frontend/$cpskin/mail/doaddpop.html?email=$euser&domain=$edomain&password=$epass&quota=$equota", 'r');
			fclose($f);
			break;
		case 'delete':
			$f = fopen("http://$cpuser:$cppass@$cpdomain:2082/frontend/$cpskin/mail/realdelpop.html?email=$euser&domain=$edomain", 'r');
			fclose($f);
			break;
		case 'forwarder_create':
			$efwd = isset($_REQUEST['fwdemail']) ? $_REQUEST['fwdemail'] : '';
			if(strlen($efwd) > 0) {
				$f = fopen("http://$cpuser:$cppass@$cpdomain:2082/frontend/$cpskin/mail/doaddfwd.html?email=$euser&domain=$edomain&fwdemail=$efwd&fwdopt=fwd", 'r');
				fclose($f);
			}
			break;
		case 'forwarder_delete':
			$efwd = isset($_REQUEST['fwdemail']) ? $_REQUEST['fwdemail'] : '';
			if(strlen($efwd) > 0) {
				$f = fopen("http://$cpuser:$cppass@$cpdomain:2082/frontend/$cpskin/mail/dodelfwd.html?email=$euser@$edomain&emaildest=$efwd", 'r');
				fclose($f);
			}
			break;
		default:
	}
}
