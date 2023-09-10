<?php
use PHPMailer\PHPMailer\PHPMailer;

require("../../vendor/autoload.php");



$mail = new PHPMailer(true);
$mail->isSMTP();
// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->SMTPAuth = true;
$mail->Host = 'smtp.example.com';
$mail->Username = 'user@example.com';
$mail->Password = 'secret';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port = 465;
$mail->isHTML(true);
return $mail;

?>