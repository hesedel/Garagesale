<?php
$cpuser = ''; // cPanel username
$cppass = ''; // cPanel password
$cpdomain = ''; // cPanel domain or IP
$cpskin = ''; // cPanel skin (x|x2|x3)

$key = ''; // security

if(isset($_REQUEST['key']) && $_REQUEST['key'] === $key) {
  switch($_REQUEST['action']) {
    case 'create':
      $euser = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
      $epass = isset($_REQUEST['password']) ? $_REQUEST['password'] : 'password';
      $edomain = isset($_REQUEST['domain']) ? $_REQUEST['domain'] : $cpdomain;
      $equota = isset($_REQUEST['quota']) ? $_REQUEST['quota'] : 10;

      $success = 0;
      if(strlen($euser) > 0) {
        while(true) {
          // create email account
          $f = fopen("http://$cpuser:$cppass@$cpdomain:2082/frontend/$cpskin/mail/doaddpop.html?email=$euser&domain=$edomain&password=$epass&quota=$equota", "r");
          if(!$f) {
            $success = 0;
            break;
          }
        
          $success = 1;
        
          // check result
          while(!feof($f)) {
            $line = fgets($f, 1024);
            if(ereg("already exists", $line, $out)) {
              $success = 0;
              break;
            }
          }

          @fclose($f);
          break;
        }
      }
      
      echo $success;
      break;
    default:
  }
}
