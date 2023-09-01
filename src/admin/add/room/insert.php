<?php
session_start();
include("../../../../database/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["room_number"]) && isset($_POST["room_type"])) {
  $room_number = $_POST["room_number"];
  $room_type = $_POST["room_type"];

  $sql_insert_room = "INSERT INTO Room (room_number, room_type) VALUES ('$room_number', '$room_type')";

  if ($conn->query($sql_insert_room) === TRUE) {



    $_SESSION['success_message'] = "Successfully Room Added";


    header('Location: add_room.php');
    exit;
  } else {

    $_SESSION['error_message'] = "Error! Time Not Added";


    header('Location: add_room.php');
    exit;
  }
}
?>