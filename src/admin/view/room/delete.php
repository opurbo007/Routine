<?php
session_start();
ob_start();
include("../../../../database/config.php");

if (isset($_GET["room_id"])) {
  $room_id = $_GET["room_id"];

  $sql_delete_room = "DELETE FROM Room WHERE room_id = $room_id";

  if ($conn->query($sql_delete_room) === TRUE) {
    $_SESSION['delete'] = "Room deleted successfully.";
  } else {
    $_SESSION['error'] = "Failed to delete the room.";
  }
} else {
  $_SESSION['error'] = "Room ID not specified.";
}


$conn->close();
ob_end_flush();

header("Location: room.php");
exit();
?>