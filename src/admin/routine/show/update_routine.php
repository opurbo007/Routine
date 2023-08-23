<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "routine";

$connection = new mysqli($servername, $username, $password, $dbname);

if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $routineId = $_POST['routine_id'];
  $newDay = $_POST['new_day'];
  $newTime = $_POST['new_time'];
  $newRoom = $_POST['new_room'];
  $newTeacher = $_POST['new_teacher'];

  // Split new_time into start_time and end_time
  list($newStartTime, $newEndTime) = explode('|', $newTime);

  // Update the routine in the database
  $updateQuery = "UPDATE routine SET day = ?, start_time = ?, end_time = ?, room_id = ?, teacher_id = ? 
                    WHERE routine_id = ?";
  $stmt = $connection->prepare($updateQuery);
  $stmt->bind_param("ssssii", $newDay, $newStartTime, $newEndTime, $newRoom, $newTeacher, $routineId);

  if ($stmt->execute()) {
    echo "Routine updated successfully.";
  } else {
    echo "Error updating routine: " . $stmt->error;
  }

  $stmt->close();
} else {
  echo "Invalid request.";
}

$connection->close();
?>