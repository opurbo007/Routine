<?php
session_start();
ob_start();

include("../../../../database/config.php");

if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["course_id"])) {
  $course_id = $_GET["course_id"];

  // Use a prepared statement to delete the course
  $stmt = $conn->prepare("DELETE FROM Course WHERE course_id = ?");
  $stmt->bind_param("i", $course_id);

  if ($stmt->execute()) {
    $_SESSION['delete'] = "Course deleted successfully.";
  } else {
    $_SESSION['error'] = "Failed to delete the course.";
  }


  $stmt->close();
} else {
  $_SESSION['error_message'] = "Course ID not specified.";
}

$conn->close();
ob_end_flush();


header("Location: course.php");
exit();
?>