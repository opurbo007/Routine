<?php
session_start();

include("../../../../database/config.php");

if (isset($_GET['id'])) {
  $teacher_id = $_GET['id'];


  $sql_delete_courses = "DELETE FROM teachercourses WHERE teacher_id = $teacher_id";

  if ($conn->query($sql_delete_courses) === TRUE) {

    $sql_delete_teacher = "DELETE FROM Teachers WHERE teacher_id = $teacher_id";

    if ($conn->query($sql_delete_teacher) === TRUE) {
      $_SESSION["delete"] = "Teacher ID deleted successfully!";
    } else {
      $_SESSION["error"] = "Error deleting Teacher ID!";
    }
  } else {
    $_SESSION["error"] = "Error deleting related records!";
  }

  header("Location: teacher.php");
  exit();
}

$conn->close();
?>