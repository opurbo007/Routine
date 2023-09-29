<?php
session_start();
ob_start();
include("../../database/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $query = "SELECT teacher_id, name, password FROM teachers WHERE mail = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $teacher = $result->fetch_assoc();

    // match input password with hashed password
    if (password_verify($password, $teacher["password"])) {
      $_SESSION["teacher_id"] = $teacher["teacher_id"];
      header("Location: ../../src/teacher/dashboard.php");
      $_SESSION["authenticated"] = true;
      $_SESSION["user_role"] = "teacher";
      exit();
    } else {
      $_SESSION["error_login"] = "Incorrect password. Please try again";
      header("Location: ./login.php");
      exit();
    }
  } else {
    $_SESSION["error_login"] = "Teacher not found with the provided email.";
    header("Location: login.php");
    exit();
  }
}

$conn->close();
?>