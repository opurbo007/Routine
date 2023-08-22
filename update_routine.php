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
  $batch = $_POST['batch'];
  $semester = $_POST['semester'];
  $session = $_POST['session'];
  $day = $_POST['day'];
  $start_time = $_POST['start_time'];
  $end_time = $_POST['end_time'];
  $newCourse = $_POST['course'];
  $newTeacher = $_POST['teacher'];
  $newRoom = $_POST['room'];

  // Update the routine with the new data
  $updateQuery = "UPDATE routine
                    SET course_id = ?, teacher_id = ?, room_id = ?
                    WHERE batch = ? AND semester = ? AND session = ? AND day = ? AND start_time = ? AND end_time = ?";
  $updateStmt = $connection->prepare($updateQuery);
  $updateStmt->bind_param(
    "iiiiissss",
    $newCourse,
    $newTeacher,
    $newRoom,
    $batch,
    $semester,
    $session,
    $day,
    $start_time,
    $end_time
  );
  $updateStmt->execute();

  echo "Routine updated successfully.";
}

$connection->close();
?>