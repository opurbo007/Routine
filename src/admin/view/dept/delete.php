<?php
session_start();

include("../../../../database/config.php");

if (isset($_GET["id"])) {
  $department_id = $_GET["id"];


  $sql = "DELETE FROM Department WHERE department_id = $department_id";
  if ($conn->query($sql) === TRUE) {
    $_SESSION["delete"] = "Department deleted successfully.";
  } else {
    $_SESSION["error"] = "Error! Department Not Deleted ";
  }

  header("Location: dept.php");
  exit();
} else {
  $_SESSION["error"] = "Department ID not provided.";
  header("Location: dept.php");
  exit();
}

$conn->close();
?>