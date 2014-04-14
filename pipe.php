#!/usr/local/bin/php -q
<?php
//include email parser  
require_once('pipe/rfc822_addresses.php');  
require_once('pipe/mime_parser.php'); 
require_once('protected/components/CSSToInlineStyles.php');

// read email in from stdin  
$fd = fopen("php://stdin", "r");  
$email = "";  
while (!feof($fd)) {  
    $email .= fread($fd, 1024);  
}  
fclose($fd);  
  
//create the email parser class  
$mime=new mime_parser_class;  
$mime->ignore_syntax_errors = 1;  
$parameters=array(  
    'Data'=>$email,  
);  
      
$mime->Decode($parameters, $decoded);  
  
//---------------------- GET EMAIL HEADER INFO -----------------------//  
  
//get the name and email of the sender  
$fromName = $decoded[0]['ExtractedAddresses']['from:'][0]['name'];  
$fromEmail = $decoded[0]['ExtractedAddresses']['from:'][0]['address'];  
  
//get the name and email of the recipient  
$toEmail = $decoded[0]['ExtractedAddresses']['to:'][0]['address'];  
$toName = $decoded[0]['ExtractedAddresses']['to:'][0]['name'];  
  
//get the subject  
$subject = $decoded[0]['Headers']['subject:'];  
  
$removeChars = array('<','>');  
  
//get the message id  
$messageID = str_replace($removeChars,'',$decoded[0]['Headers']['message-id:']);  
  
//get the reply id  
$replyToID = str_replace($removeChars,'',$decoded[0]['Headers']['in-reply-to:']);  
  
  
//---------------------- FIND THE BODY -----------------------//  
  
//get the message body  
if(substr($decoded[0]['Headers']['content-type:'],0,strlen('text/plain')) == 'text/plain' && isset($decoded[0]['Body'])){  
      
    $body = $decoded[0]['Body'];  
  
} elseif(substr($decoded[0]['Parts'][0]['Headers']['content-type:'],0,strlen('text/plain')) == 'text/plain' && isset($decoded[0]['Parts'][0]['Body'])) {  
      
    $body = $decoded[0]['Parts'][0]['Body'];  
  
} elseif(substr($decoded[0]['Parts'][0]['Parts'][0]['Headers']['content-type:'],0,strlen('text/plain')) == 'text/plain' && isset($decoded[0]['Parts'][0]['Parts'][0]['Body'])) {  
      
    $body = $decoded[0]['Parts'][0]['Parts'][0]['Body'];  
  
}
  
//print out our data  
$message = "<br><br>Message ID: $messageID<br><br>Reply ID: $replyToID<br><br>Subject: $subject<br><br>To: $toName $toEmail<br><br>From: $fromName $fromEmail<br><br>Body: $body<br><br>";  

/*
- Send out template on first message.
1. Convert HEX to ID
2. Then retrieve data from "item_contact" table using the converted ID. 
*/

ob_start();

/*
Get these datas and send it to the file:
$name
$link
$team name
*/
$name = 'Janzen';
$link = 'http://local.garagsale.com';
$team = 'Garagesale';
include('pipe/_emailTemplate.php');
$template = ob_get_clean();

ob_start();
include('css/emailWrapper.css');
$css = ob_get_clean();
$body=new CSSToInlineStyles(
	$template,$css
);

// $headers = "From: " . $fromEmail . "\r\n";
// $headers .= "Reply-To: ". $toEmail . "\r\n";
// $headers .= "CC: susan@example.com\r\n";
// $headers .= "MIME-Version: 1.0\r\n";
// $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$header = "From: noreply@example.com\r\n"; 
$header.= "MIME-Version: 1.0\r\n"; 
$header.= "Content-Type: text/html; charset=utf-8\r\n"; 
// $headers .= "Reply-To: ". $toEmail . "\r\n";

$body = $fromEmail ."\n";
$body .= $fromName ."\n";
$body .= $toEmail ."\n";
$body .= $toName ."\n";

//show all the decoded email info  
// print_r($decoded); 
mail('janzen.contact@gmail.com', $subject, $body, $headers);
