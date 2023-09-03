<?php
session_start();
include("../../../../database/config.php");

if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["batch_id"])) {
  $batch_id = $_GET["batch_id"];
  $sql_delete_batch = "DELETE FROM Batch WHERE batch_id = $batch_id";

  if ($conn->query($sql_delete_batch) === TRUE) {
    $_SESSION['delete'] = "Batch deleted successfully!";

  } else {
    $_SESSION['error'] = "Error deleting batch";
  }
  header("Location: batch.php");
  exit;
}

$conn->close();


?>