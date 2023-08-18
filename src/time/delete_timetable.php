<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "routine";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['timetable_id'])) {
  $timetable_id = $_GET['timetable_id'];

  $sql_delete_timetable = "DELETE FROM timeslot WHERE timetable_id=$timetable_id";

  if ($conn->query($sql_delete_timetable) === TRUE) {
    echo "Timetable entry deleted successfully!";
  } else {
    echo "Error deleting timetable entry: " . $conn->error;
  }
} else {
  echo "Timetable ID not specified.";
}

$conn->close();
?>