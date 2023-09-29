<?php
session_start();

include("../../database/config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["admin_login"])) {
  $admin_email = $_POST["admin_email"];
  $admin_password = $_POST["admin_password"];

  $query = "SELECT * FROM admins WHERE email = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $admin_email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $admin_data = $result->fetch_assoc();
    $admin_password = $admin_data["password"];
    $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

    // match password
    if (password_verify($admin_password, $hashed_password)) {

      $_SESSION["admin_id"] = $admin_data["id"];
      $_SESSION["admin_email"] = $admin_data["email"];

      $_SESSION["authenticated"] = true;
      header("Location: ../../src/admin/view/overview/dashboard.php");
      exit();
    } else {
      $_SESSION["error_message"] = "Incorrect password. Please try again";
    }
  } else {
    $_SESSION["error_message"] = "Admin not found with the provided email.";
  }

  header("Location: login.php");
  exit();
}
?>