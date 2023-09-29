<?php

use PHPMailer\PHPMailer\PHPMailer;

include("../../database/config.php");

$email = $_POST["email"];


$token = bin2hex(random_bytes(16));

$expiry = date("Y-m-d H:i:s", time() + 60 * 10);

$sql = "UPDATE teachers SET token = ?,
                      expiry= ?
                      WHERE mail = ?";
$stmt = $conn->prepare($sql);

$stmt->bind_param("sss", $token, $expiry, $email);

$stmt->execute();

if ($stmt->affected_rows) {
  require("../../vendor/autoload.php");

  $mail = new PHPMailer(TRUE);
  $mail->isSMTP();
  $mail->SMTPAuth = TRUE;
  $mail->SMTPSecure = "tls";

  $mail->Host = "smtp.gmail.com";
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port = 587;
  $mail->Username = "opurbodiu51@gmail.com";
  $mail->Password = "yrfafjbesplmanno";
  $mail->isHtml(TRUE);
  $mail->setFrom("opurbodiu51@gmail.com");
  $mail->addAddress($email);
  $mail->Subject = "Password Reset";
  $mail->Body = <<<END
  Click <a href="http://localhost/rou/login/teacher/reset_password.php?token={$token}">Here</a> to reset your password.
  END;

  try {
    $mail->send();
    echo "Message sent to your email with reset link. Please check your inbox.";
  } catch (Exception $e) {
    echo "Message not sent. Something went wrong: {$mail->ErrorInfo}";
  }
} else {
  echo "Email address not registered";
}
?>