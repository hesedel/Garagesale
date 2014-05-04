<?php
$cpuser = ''; // cPanel username
$cppass = ''; // cPanel password
$cpdomain = ''; // cPanel domain or IP
$cpskin = ''; // cPanel skin (x|x2|x3)

$key = ''; // security

$domain = isset($_REQUEST['domain']) ? $_REQUEST['domain'] : $cpdomain;

if(isset($_REQUEST['key']) && $_REQUEST['key'] === $key) {
	switch($_REQUEST['action']) {
		case 'index';
			$accounts = array();
			$contents = file_get_contents("http://$cpuser:$cppass@$cpdomain:2082/frontend/$cpskin/mail/pops_noscript.html");
			$lines = explode("\n", $contents);
			foreach($lines as $line) {
				preg_match('/dodelpop.html?.+&amp;email=(.+)&amp;domain=' . str_replace('.', '\.', $domain) . '/', $line, $matches);
				if(sizeof($matches) > 0) {
					$accounts[] = $matches[1];
				}
			}
			foreach($accounts as $account) {
				echo $account . "\n";
			}
			break;
		case 'create':
			$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
			if(strlen($email) > 0) {
				$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : 'password';
				$quota = isset($_REQUEST['quota']) ? $_REQUEST['quota'] : 10;
				$f = fopen("http://$cpuser:$cppass@$cpdomain:2082/frontend/$cpskin/mail/doaddpop.html?email=$email&domain=$domain&password=$password&quota=$quota", 'r');
				fclose($f);
			}
			break;
		case 'delete':
			$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
			if(strlen($email) > 0) {
				$f = fopen("http://$cpuser:$cppass@$cpdomain:2082/frontend/$cpskin/mail/realdelpop.html?email=$email&domain=$domain", 'r');
				fclose($f);
			}
			break;
		case 'delete_all':
			$done = false;
			while(!$done) {
				$contents = file_get_contents(strtok('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], '?') . '?key=' . urlencode($key) . "&action=index&domain=$domain");
				if(strlen($contents) == 0) {
					$done = true;
				}
				$lines = explode("\n", $contents);
				foreach($lines as $line) {
					$f = fopen(strtok('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], '?') . '?key=' . urlencode($key) . "&action=delete&email=$line&domain=$domain", 'r');
					fclose($f);
				}
			}
			break;
		case 'forwarder_index':
			$forwarders = array();
			$contents = file_get_contents("http://$cpuser:$cppass@$cpdomain:2082/frontend/$cpskin/mail/fwds.html");
			$lines = explode("\n", $contents);
			foreach($lines as $line) {
				preg_match('/dodelfwdconfirm.html?.+&amp;email=(.+)%40' . str_replace('.', '\.', $domain) . '&amp;emaildest=(.+)"/', $line, $matches);
				if(sizeof($matches) > 0) {
					$forwarders[] = $matches[1] . ' ' . $matches[2];
				}
			}
			foreach($forwarders as $forward) {
				echo $forward . "\n";
			}
			break;
		case 'forwarder_create':
			$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
			$fwdopt = isset($_REQUEST['fwdopt']) ? $_REQUEST['fwdopt'] : '';
			$fwdemail = isset($_REQUEST['fwdemail']) ? $_REQUEST['fwdemail'] : '';
			$pipefwd = isset($_REQUEST['pipefwd']) ? $_REQUEST['pipefwd'] : '';
			if(strlen($email) > 0 && strlen($fwdopt) > 0) {
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
			$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
			$emaildest = isset($_REQUEST['emaildest']) ? $_REQUEST['emaildest'] : '';
			if(strlen(strlen($email) > 0 && $emaildest) > 0) {
				$f = fopen("http://$cpuser:$cppass@$cpdomain:2082/frontend/$cpskin/mail/dodelfwd.html?email=$email@$domain&emaildest=$emaildest", 'r');
				fclose($f);
			}
			break;
		case 'forwarder_delete_all':
			$done = false;
			while(!$done) {
				$contents = file_get_contents(strtok('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], '?') . '?key=' . urlencode($key) . "&action=forwarder_index&domain=$domain");
				if(strlen($contents) == 0) {
					$done = true;
				}
				$lines = explode("\n", $contents);
				foreach($lines as $line) {
					$debris = explode(' ', $line);
					$f = fopen(strtok('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], '?') . '?key=' . urlencode($key) . "&action=forwarder_delete&email=$debris[0]&domain=$domain&emaildest=$debris[1]", 'r');
					fclose($f);
				}
			}
			break;
		default:
	}
}
