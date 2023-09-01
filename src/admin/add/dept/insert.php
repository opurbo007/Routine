<?php
session_start();
include("../../../../database/config.php");



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $department_name = $_POST["department_name"];

  // Insert the new department into the Department table
  $sql_insert_department = "INSERT INTO Department (department_name) VALUES ('$department_name')";

  if ($conn->query($sql_insert_department) === TRUE) {
    $_SESSION['success_message'] = "Successfully TimeSlot Added";

    // Redirect to the add_timetable.php page
    header('Location: add_department.php');
    exit;
  } else {
    // Set the error message in the session variable (if needed)
    $_SESSION['error_message'] = "Error! Time Not Added";

    // Redirect to the add_timetable.php page
    header('Location: add_department.php');
    exit;
  }
}
?>