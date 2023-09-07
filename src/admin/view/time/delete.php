<?php
session_start();

include("../../../../database/config.php");

if (isset($_GET['timetable_id'])) {
  $timetable_id = $_GET['timetable_id'];

  $sql_delete_timetable = "DELETE FROM timeslot WHERE timetable_id=$timetable_id";

  if ($conn->query($sql_delete_timetable) === TRUE) {
    $_SESSION["delete"] = "TimeSlot deleted successfully!";
  } else {
    $_SESSION["error"] = "Error deleting Timeslot!";
  }
} else {
  $_SESSION["error"] = "TImeSlot ID not Spcified!";
}
$conn->close();
ob_end_flush();
header("Location: timetable.php");
exit();

?>