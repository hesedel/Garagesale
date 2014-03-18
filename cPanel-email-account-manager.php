<?php
$cpuser = ''; // cPanel username
$cppass = ''; // cPanel password
$cpdomain = ''; // cPanel domain or IP
$cpskin = ''; // cPanel skin (x|x2|x3)

$key = ''; // security

$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
$domain = isset($_REQUEST['domain']) ? $_REQUEST['domain'] : $cpdomain;

if(isset($_REQUEST['key']) && $_REQUEST['key'] === $key && strlen($email) > 0) {
	switch($_REQUEST['action']) {
		case 'create':
			$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : 'password';
			$quota = isset($_REQUEST['quota']) ? $_REQUEST['quota'] : 10;
			$f = fopen("http://$cpuser:$cppass@$cpdomain:2082/frontend/$cpskin/mail/doaddpop.html?email=$email&domain=$domain&password=$password&quota=$quota", 'r');
			fclose($f);
			break;
		case 'delete':
			$f = fopen("http://$cpuser:$cppass@$cpdomain:2082/frontend/$cpskin/mail/realdelpop.html?email=$email&domain=$domain", 'r');
			fclose($f);
			break;
		case 'forwarder_create':
			$fwdopt = isset($_REQUEST['fwdopt']) ? $_REQUEST['fwdopt'] : '';
			$fwdemail = isset($_REQUEST['fwdemail']) ? $_REQUEST['fwdemail'] : '';
			$pipefwd = isset($_REQUEST['pipefwd']) ? $_REQUEST['pipefwd'] : '';
			if(strlen($fwdopt) > 0) {
				if(strlen($fwdemail) > 0) {
					$f = fopen("http://$cpuser:$cppass@$cpdomain:2082/frontend/$cpskin/mail/doaddfwd.html?email=$email&domain=$domain&fwdopt=$fwdopt&fwdemail=$fwdemail", 'r');
					fclose($f);
				}
				if(strlen($pipefwd) > 0) {
					$f = fopen("http://$cpuser:$cppass@$cpdomain:2082/frontend/$cpskin/mail/doaddfwd.html?email=$email&domain=$domain&fwdopt=$fwdopt&pipefwd=$pipefwd", 'r');
					fclose($f);
				}
				
			}
			break;
		case 'forwarder_delete':
			$emaildest = isset($_REQUEST['emaildest']) ? $_REQUEST['emaildest'] : '';
			if(strlen($emaildest) > 0) {
				$f = fopen("http://$cpuser:$cppass@$cpdomain:2082/frontend/$cpskin/mail/dodelfwd.html?email=$email@$domain&emaildest=$emaildest", 'r');
				fclose($f);
			}
			break;
		default:
	}
}
