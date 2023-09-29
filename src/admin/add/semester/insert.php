<?php
session_start();
include("../../../../database/config.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $semester_name = $_POST["semester_name"];
  $department_id = $_POST["department_id"];

  // Insert new semester
  $sql_insert_semester = "INSERT INTO Semester (semester_name, department_id) VALUES ('$semester_name', $department_id)";

  if ($conn->query($sql_insert_semester) === TRUE) {



    $_SESSION['success_message'] = "Successfully Semester Added";

    header('Location: add_semester.php');
    exit;
  } else {

    $_SESSION['error_message'] = "Error! Semester Not Added";

    header('Location: add_semester.php');
    exit;
  }
}
?>