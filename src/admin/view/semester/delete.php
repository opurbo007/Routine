<?php
session_start();

include("../../../../database/config.php");

if (isset($_GET["action"]) && $_GET["action"] === "delete" && isset($_GET["semester_id"])) {
  $semester_id = $_GET["semester_id"];

  // Delete the semester from the Semester table
  $sql_delete_semester = "DELETE FROM Semester WHERE semester_id = $semester_id";

  if ($conn->query($sql_delete_semester) === TRUE) {
    $_SESSION["delete"] = "Semester deleted successfully!";
  } else {
    $_SESSION["error"] = "Error deleting semester!";
  }

  header("Location: semester.php");
  exit();
}

$conn->close();
?>