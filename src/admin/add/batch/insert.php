<?php
session_start();
include("../../../../database/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $batch_number = $_POST["batch_number"];
  $department_id = $_POST["department_id"];
  $batch_shift = $_POST["batch_shift"];

  // Check if the batch already exist
  $sql_check_batch = "SELECT * FROM Batch WHERE batch_number = '$batch_number' AND department_id = $department_id AND batch_shift = '$batch_shift'";
  $result_check_batch = $conn->query($sql_check_batch);

  if ($result_check_batch->num_rows > 0) {
    $_SESSION['exist'] = "Batch Already Exist!";

    header('Location: add_batch.php');
    exit;
  } else {
    // Insert the new batch into the Batch table
    $sql_insert_batch = "INSERT INTO Batch (batch_number, department_id, batch_shift) VALUES ('$batch_number', $department_id, '$batch_shift')";

    if ($conn->query($sql_insert_batch) === TRUE) {



      $_SESSION['success_message'] = "Successfully Batch Added";


      header('Location: add_batch.php');
      exit;
    } else {

      $_SESSION['error_message'] = "Error! Batch Not Added";

      header('Location: add_batch.php');
      exit;
    }
  }
}
?>