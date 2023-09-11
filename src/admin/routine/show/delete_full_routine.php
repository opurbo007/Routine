<?php
include("../../../../database/config.php");

if (isset($_GET['batchId']) && isset($_GET['semesterName']) && isset($_GET['session'])) {
  $batchId = $_GET['batchId'];
  $semesterName = $_GET['semesterName'];
  $session = $_GET['session'];

  // Construct the SQL query to delete routines for the specified batch, semester, and session
  $deleteQuery = "DELETE FROM routine 
                    WHERE batch = ? 
                    AND semester = (SELECT semester_id FROM semester WHERE semester_name = ?)
                    AND session = ?";

  $deleteStmt = $conn->prepare($deleteQuery);
  $deleteStmt->bind_param("iss", $batchId, $semesterName, $session);

  if ($deleteStmt->execute()) {

    header("Location: batche_show.php");
    exit();
  } else {
    echo "Error deleting routines: " . $conn->error;
  }

  $deleteStmt->close();
}

$conn->close();
?>