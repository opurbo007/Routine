<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "routine";

// database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if successful
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>