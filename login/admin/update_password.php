<?php
session_start();
include("../../database/config.php");

if (isset($_GET["token"])) {
  $token = $_GET["token"];
  echo $token;
  $sql = "SELECT * FROM admins WHERE token = ?";

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

  // Valid token
  $newPassword = $_GET["password"];
  $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

  $sql = "UPDATE admins SET password = ?,
                            token = NULL,
                            expiry = NULL 
                    WHERE id = ?";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $hashedPassword, $user["id"]);
  if ($stmt->execute()) {

    header("Location: login.php");
    exit();
  } else {
    die("Password update failed");
  }
} else {
  die("Invalid token");
}
?>