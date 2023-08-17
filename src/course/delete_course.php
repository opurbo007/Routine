<!DOCTYPE html>
<html>

<head>
  <title>Delete Course</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

  $course_id = $_GET['id'];

  // Retrieve course details from the database
  $sql_course = "SELECT Course.*, department_name, semester_name FROM Course
                INNER JOIN department ON Course.department_id = department.department_id
                INNER JOIN semester ON Course.semester_id = semester.semester_id
                WHERE course_id = '$course_id'";
  $result_course = $conn->query($sql_course);
  $course = $result_course->fetch_assoc();

  ?>

  <h2>Delete Course</h2>
  <p>Are you sure you want to delete the following course?</p>
  <p><strong>Course Code:</strong>
    <?php echo $course['course_code']; ?>
  </p>
  <p><strong>Course Name:</strong>
    <?php echo $course['course_name']; ?>
  </p>
  <p><strong>Credits:</strong>
    <?php echo $course['credits']; ?>
  </p>
  <p><strong>Department:</strong>
    <?php echo $course['department_name']; ?>
  </p>
  <p><strong>Semester:</strong>
    <?php echo $course['semester_name']; ?>
  </p>

  <form method="post">
    <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
    <input type="submit" name="delete" value="Delete">
    <a href="course.php">Cancel</a>
  </form>

  <?php
  if (isset($_POST['delete'])) {
    $course_id_to_delete = $_POST['course_id'];

    // Delete course from the database
    $sql_delete_course = "DELETE FROM Course WHERE course_id = '$course_id_to_delete'";

    if ($conn->query($sql_delete_course) === TRUE) {
      echo "<p>Course deleted successfully!</p>";
    } else {
      echo "<p>Error deleting course: " . $conn->error . "</p>";
    }
  }

  // Close the database connection
  $conn->close();
  ?>
</body>

</html>