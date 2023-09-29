<?php
session_start();
include("../../../../database/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $course_code = $_POST["course_code"];
  $course_name = $_POST["course_name"];
  $semester_id = $_POST["semester_id"];
  $course_type = $_POST["course_type"];
  $credits = floatval($_POST["credits"]);
  $department_id = $_POST["department_id"]; 

  // Insert course into databse
  $sql_insert_course = "INSERT INTO Course (course_code, course_name, department_id, semester_id, course_type, credits) VALUES ('$course_code', '$course_name', $department_id, $semester_id, '$course_type', $credits)";

  if ($conn->query($sql_insert_course) === TRUE) {



    $_SESSION['success_message'] = "Successfully Course Added";

    header('Location: add_course.php');
    exit;
  } else {

    $_SESSION['error_message'] = "Error! Course Not Added";


    header('Location: add_course.php');
    exit;
  }
}
?>