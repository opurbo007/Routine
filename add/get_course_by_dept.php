<?php
// Replace these variables with your database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "routine";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["department_id"])) {
  $department_id = $_GET["department_id"];

  // Fetch courses for the selected department
  $sql_courses = "SELECT * FROM Course WHERE department_id = $department_id";
  $result_courses = $conn->query($sql_courses);

  if ($result_courses->num_rows > 0) {
    echo "<ul>";
    while ($row = $result_courses->fetch_assoc()) {
      $course_code = $row["course_code"];
      $course_name = $row["course_name"];
      echo "<li><input type='checkbox' name='courses[]' value='$course_code'>$course_name</li>";
    }
    echo "</ul>";
  } else {
    echo "<p>No courses available for this department.</p>";
  }
}

// Close the database connection
$conn->close();
?>