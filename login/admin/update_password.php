<?php
session_start();
include("../../database/config.php");

if (isset($_GET["token"])) {
  $token = $_GET["token"];

  $token_hash = hash("sha256", $token);

  $sql = "SELECT * FROM admins WHERE token = ?";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $token_hash);

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
  $newPassword = $_POST["password"];
  $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

  $sql = "UPDATE admins SET password = ?,
                            token = NULL,
                            expiry = NULL 
                    WHERE id = ?";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $hashedPassword, $user["id"]);
  if ($stmt->execute()) {
    // Password updated successfully
    // Redirect the user to the login page
    header("Location: login.php");
    exit();
  } else {
    die("Password update failed");
  }
} else {
  die("Invalid token");
}
?>