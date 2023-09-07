<?php

session_start();
ob_start();

include("../../../../database/config.php");
include("../../../include/adminNavbar.php");



if (isset($_GET['routine_id'])) {
  $routineId = $_GET['routine_id'];

  // Delete the routine from the database
  $deleteQuery = "DELETE FROM routine WHERE routine_id = ?";
  $stmt = $conn->prepare($deleteQuery);
  $stmt->bind_param("i", $routineId);

  if ($stmt->execute()) {
    $_SESSION['success_message'] = "Routine deleted successfully.";
  } else {
    $_SESSION['error_message'] = "Error deleting routine! ";
  }

  $stmt->close();
  header('Location: select.php');
  exit;
} else {
  $_SESSION['error_message'] = "Routine ID not provided.";
  header('Location: select.php');
  exit;
}


?>