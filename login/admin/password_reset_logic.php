<?php
session_start();
include("../../database/config.php");

$email = $_POST["email"];

$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 10);

$sql = "UPDATE admins SET token = ?,
                      expiry= ?
                      WHERE email = ?";
$stmt = $conn->prepare($sql);

$stmt->bind_param("sss", $token, $expiry, $email);

$stmt->execute();

if ($stmt->affected_rows) {
  $mail = require __DIR__ . "/mailer.php";
  $mail->addAddress($email);
  $mail->Subject = "Password Reset";
  $mail->Body = <<<END

  Click <a href="http://http://localhost/rou/login/admin/reset_password.php?token=<?php echo $token; ?>">Here</a> to reset your password.


  END;


  try {
    $mail->send();
    echo " Message sent to your email with reset link. Please check your inbox.";
  } catch (Exception $e) {

    echo "Meessage not send. Something went wrong {$mail->ErrorInfo}";
  }
} else {
  echo "mail address not registered";
}


?>