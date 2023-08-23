<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "routine";

$connection = new mysqli($servername, $username, $password, $dbname);

if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}

if (isset($_GET['routine_id'])) {
  $routineId = $_GET['routine_id'];

  // Delete the routine from the database
  $deleteQuery = "DELETE FROM routine WHERE routine_id = ?";
  $stmt = $connection->prepare($deleteQuery);
  $stmt->bind_param("i", $routineId);

  if ($stmt->execute()) {
    echo "Routine deleted successfully.";
  } else {
    echo "Error deleting routine: " . $stmt->error;
  }

  $stmt->close();
} else {
  echo "Routine ID not provided.";
}

$connection->close();
?>