<?php
session_start();
include("../../../../database/config.php");



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $department_name = $_POST["department_name"];

  // Insert 
  $sql_insert_department = "INSERT INTO Department (department_name) VALUES ('$department_name')";

  if ($conn->query($sql_insert_department) === TRUE) {
    $_SESSION['success_message'] = "Successfully TimeSlot Added";


    header('Location: add_department.php');
    exit;
  } else {

    $_SESSION['error_message'] = "Error! Time Not Added";


    header('Location: add_department.php');
    exit;
  }
}
?>