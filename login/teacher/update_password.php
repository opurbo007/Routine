<?php
session_start();
include("../../database/config.php");

if (isset($_GET["token"])) {
  $token = $_GET["token"];

  $sql = "SELECT * FROM teachers WHERE token = ?";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $token);

  $stmt->execute();

  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user === null) {
    die("Token Not Found");
  }

  if (strtotime($user["expiry"]) <= time()) {
    die("Link Expired");
  }

  // Valid token, continue with password update
  $newPassword = $_GET["password"];
  $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
  echo "New Password: " . $newPassword . "<br>";
  echo "Hashed Password: " . $hashedPassword . "<br>";

  $sql = "UPDATE teachers SET password = ?, token = NULL, expiry = NULL WHERE teacher_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $hashedPassword, $user["teacher_id"]);


  if ($stmt->execute()) {
    // Password updated successfully
    header("Location: login.php");
    exit();
  } else {
    // Password update failed, display error
    die("Password update failed: " . $stmt->error);
  }


} else {
  die("Invalid token");
}
?>