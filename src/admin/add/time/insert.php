<?php
session_start();
include("../../../../database/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $start_time = $_POST["start_hour"] . ":" . $_POST["start_minute"] . ":00";
  $end_time = $_POST["end_hour"] . ":" . $_POST["end_minute"] . ":00";
  $class_type = $_POST["class_type"];

  $sql_insert_timetable = "INSERT INTO timeslot (start_time, end_time, class_type) VALUES ('$start_time', '$end_time', '$class_type')";

  if ($conn->query($sql_insert_timetable) === TRUE) {
    // Set the success message in the session variable
    $_SESSION['success_message'] = "Successfully TimeSlot Added";

    header('Location: add_timetable.php');
    exit;
  } else {

    $_SESSION['error_message'] = "Error! Time Not Added";


    header('Location: add_timetable.php');
    exit;
  }
}
?>