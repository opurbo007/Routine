<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "routine";

// database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check successful or not
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>