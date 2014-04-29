#!/usr/local/bin/php -q
<?php
//include email parser  
require_once('pipe/rfc822_addresses.php');  
require_once('pipe/mime_parser.php'); 
require_once('pipe/db_connection.php'); 
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
// $message = "<br><br>Message ID: $messageID<br><br>Reply ID: $replyToID<br><br>Subject: $subject<br><br>To: $toName $toEmail<br><br>From: $fromName $fromEmail<br><br>Body: $body<br><br>";  

/*
- Send out template on first message.
1. Convert HEX to ID
2. Then retrieve data from "item_contact" table using the converted ID. 
*/

$token = explode('.', $toEmail);
$split = explode('@', $token[2]);
$recipient = $token[0];
$item_id = $token[1];
$convo_id = base_convert($split[0],36,10);
// $convo_id = $split[0];

/**
* Get row from item_contact table
* $item_contact = SELECT * FROM item_contact WHERE id = $convo_id
*/
$item_contact_result = $mysqli->query("SELECT * FROM item_contact WHERE id = $convo_id");
$item_contact = $item_contact_result->fetch_array(MYSQLI_ASSOC);
$item_id = $item_contact['item_id'];
$replier_id = $item_contact['user_id_replier'];
$poster_id = $item_contact['user_id_poster'];

$item_result = $mysqli->query("SELECT * FROM item WHERE id = $item_id");
$item = $item_result->fetch_array(MYSQLI_ASSOC);

// Check if the message is sent to either replier or poster
if ( $recipient == 'replier' ) {
	// If replier get the replier's email via $replier_id
	// If replier_id is not empty
	if ( $replier_id ) {
		$result = $mysqli->query("SELECT email FROM user WHERE id = $replier_id");
		$recipient_user = $result->fetch_array(MYSQLI_ASSOC);
		$recipient_email = $recipient_user['email'];
	} else {
		// If $replier_id is empty then get the email from the item_contact table instead
		$recipient_email = $item_contact['replier_email'];
	}
	
	$sender_email = str_replace('replier', 'poster', $toEmail);
} else {
	$result = $mysqli->query("SELECT * FROM user WHERE id = $poster_id");
	$recipient_user = $result->fetch_array(MYSQLI_ASSOC);
	$recipient_email = $recipient_user['email'];

	$sender_email = str_replace('poster', 'replier', $toEmail);
}



$headers = "From: " . $sender_email . "\r\n";
$headers .= "Reply-To: ". $sender_email . "\r\n";
// $headers .= "CC: test@example.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

// Tweaked for initial message.
if ( $item_contact_result->num_rows > 1 )
	$subject = 'Inquiry for '.$item['title'];

// Get Template
ob_start();
include('pipe/_emailTemplate.php');
$template = ob_get_clean();

// Get CSS
ob_start();
include('css/emailWrapper.css');
$css = ob_get_clean();
$html=new CSSToInlineStyles(
	$template,$css
);

// $body = $html->convert();
$body = var_export($recipient_email,true);
$body = "\n\n";
$body = var_export($fromEmail,true);
$body = "\n\n";
$body = var_export($toEmail,true);

mail('janzen.contact@gmail.com', $subject, $body, $headers);

// $header = "From: ".$sender_email."\r\n"; 
// $header.= "MIME-Version: 1.0\r\n"; 
// $header.= "Content-Type: text/html; charset=utf-8\r\n"; 
// $headers .= "Reply-To: ". $toEmail . "\r\n";

// $body = "From Email: {$fromEmail} \n";
// $body .= "From Name: {$fromName} \n";
// $body .= "To Email: {$toEmail} \n";
// $body .= "To Name: {$toName} \n";
// $body .= "/************************/ \n";
// $body .= "Sender Email: {$sender_email} \n";
// $body .= "Recipient Email: {$recipient_email} \n";

/* free result set */
$item_contact_result->free();
$item_result->free();

if ( is_object($result) )
	$result->free();

/* close connection */
$mysqli->close();
