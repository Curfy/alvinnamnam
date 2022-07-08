<?php

$email = $_POST['sender'];
$code = $_POST['code'];
// $email = "curfyfox@gmail.com";
// $email = "zenocyfox@gmail.com";     


ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
$from = "Alvinnamnam@alvinnamnam.online";
// $to = "zenocyfox@gmail.com";
$to = $email;

$subject = "Verify Your New Password Change";

$message = "<p style='font-size:120%'>To change your current password, please use the following One Time Password (OTP):</p>";
$message .= "<h2><br><b>".$code."</b></br></h2>";
$message .= "<p style='font-size:120%'><br>Do not share this OTP with anyone. Alvinnamnam takes your account security very seriously. Alvinnamnam Personnel will never ask you to disclose or verify your Alvinnamnam password, OTP, credit card, or banking account number. If you receive a suspicious email with a link to update your account information, do not click on the link—instead, report the email to Avinnamnam for investigation.<br><br>Thank you!</p>";

$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From:" . $from;

if(mail($to,$subject,$message, $headers)) {
    echo "The email message was sent.";
} else {
    echo "The email message was not sent.";
}

// $otplength = 4;

// $generator = "1357902468";
// $code = "";
// for ($i = 1; $i <= $otplength; $i++) {
//     $code .= substr($generator, (rand()%(strlen($generator))), 1);
// }

// ini_set( 'display_errors', 1 );
// error_reporting( E_ALL );
// $from = "Alvinnamnam@alvinnamnam.online";
// // $to = "zenocyfox@gmail.com";
// $to = $email;

// $subject = "Verify Your New Password Change";

// $message = "<p style='font-size:120%'>To change your current password, please use the following One Time Password (OTP):</p>";
// $message .= "<h2><br><b>".$code."</b></br></h2>";
// $message .= "<p style='font-size:120%'><br>Do not share this OTP with anyone. Alvinnamnam takes your account security very seriously. Alvinnamnam Personnel will never ask you to disclose or verify your Alvinnamnam password, OTP, credit card, or banking account number. If you receive a suspicious email with a link to update your account information, do not click on the link—instead, report the email to Avinnamnam for investigation.<br><br>Thank you!</p>";

// $headers = 'MIME-Version: 1.0' . "\r\n";
// $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// $headers .= "From:" . $from;

// if(mail($to,$subject,$message, $headers)) {
//     echo "The email message was sent.";
// } else {
//     echo "The email message was not sent.";
// }
?>