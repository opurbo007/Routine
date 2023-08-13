<!DOCTYPE html>
<html>

<head>
  <title>Edit Course</title>
</head>

<body>
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

  // Handle the form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["course_id"])) {
    $course_id = $_POST["course_id"];
    $course_code = $_POST["course_code"];
    $course_name = $_POST["course_name"];

    // Update the course in the Course table
    $sql_update_course = "UPDATE Course SET course_code = '$course_code', course_name = '$course_name' WHERE course_id = $course_id";

    if ($conn->query($sql_update_course) === TRUE) {
      echo "<p>Course updated successfully!</p>";
    } else {
      echo "<p>Error updating course: " . $conn->error . "</p>";
    }
  }

  // Retrieve course details from database
  if (isset($_GET["course_id"])) {
    $course_id = $_GET["course_id"];
    $sql_get_course = "SELECT * FROM Course WHERE course_id = $course_id";
    $result_get_course = $conn->query($sql_get_course);
    $row = $result_get_course->fetch_assoc();
  }

  // Close the database connection
  $conn->close();
  ?>

  <h2>Edit Course</h2>
  <form method="post">
    <input type="hidden" name="course_id" value="<?php echo $row['course_id']; ?>">
    <label for="course_code">Course Code:</label>
    <input type="text" id="course_code" name="course_code" value="<?php echo $row['course_code']; ?>" required>
    <br><br>
    <label for="course_name">Course Name:</label>
    <input type="text" id="course_name" name="course_name" value="<?php echo $row['course_name']; ?>" required>
    <br><br>
    <input type="submit" value="Update Course">
  </form>
</body>

</html>