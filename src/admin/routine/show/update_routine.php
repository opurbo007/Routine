<?php

session_start();
ob_start();

include("../../../../database/config.php");
include("../../../include/adminNavbar.php");



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $routineId = $_POST['routine_id'];
  $newDay = $_POST['new_day'];
  $newTime = $_POST['new_time'];
  $newRoom = $_POST['new_room'];
  $newTeacher = $_POST['new_teacher'];

  // Split new_time into start_time and end_time
  list($newStartTime, $newEndTime) = explode('|', $newTime);

  $updateQuery = "UPDATE routine SET day = ?, start_time = ?, end_time = ?, room_id = ?, teacher_id = ? 
                    WHERE routine_id = ?";
  $stmt = $conn->prepare($updateQuery);
  $stmt->bind_param("ssssii", $newDay, $newStartTime, $newEndTime, $newRoom, $newTeacher, $routineId);

  if ($stmt->execute()) {
    $_SESSION['success_message'] = "Routine updated successfully.";
  } else {
    $_SESSION['error_message'] = "Error updating routine! ";
  }

  $stmt->close();
  header('Location: select.php');
  exit;
} else {
  $_SESSION['error_message'] = "Invalid request.";
  header('Location: select.php');
  exit;
}
?>