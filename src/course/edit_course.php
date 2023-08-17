<!DOCTYPE html>
<html>

<head>
  <title>Edit Course</title>
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
  $sql_course = "SELECT * FROM Course WHERE course_id = '$course_id'";
  $result_course = $conn->query($sql_course);
  $course = $result_course->fetch_assoc();

  // Fetch departments for dropdown
  $sql_departments = "SELECT * FROM department";
  $result_departments = $conn->query($sql_departments);

  // Fetch semesters for dropdown
  $sql_semesters = "SELECT * FROM Semester";
  $result_semesters = $conn->query($sql_semesters);

  ?>

  <h2>Edit Course</h2>
  <form method="post">
    <label for="course_code">Course Code:</label>
    <input type="text" id="course_code" name="course_code" value="<?php echo $course['course_code']; ?>"
      required><br><br>

    <label for="course_name">Course Name:</label>
    <input type="text" id="course_name" name="course_name" value="<?php echo $course['course_name']; ?>"
      required><br><br>

    <label for="credits">Credits:</label>
    <input type="number" id="credits" name="credits" value="<?php echo $course['credits']; ?>" required><br><br>

    <label for="department_id">Select Department:</label>
    <select id="department_id" name="department_id" required>
      <?php
      if ($result_departments->num_rows > 0) {
        while ($row = $result_departments->fetch_assoc()) {
          $department_id = $row['department_id'];
          $department_name = $row['department_name'];
          $selected = ($department_id == $course['department_id']) ? 'selected' : '';
          echo "<option value='$department_id' $selected>$department_name</option>";
        }
      }
      ?>
    </select><br><br>

    <label for="semester_id">Select Semester:</label>
    <select id="semester_id" name="semester_id" required>
      <?php
      if ($result_semesters->num_rows > 0) {
        while ($row = $result_semesters->fetch_assoc()) {
          $semester_id = $row['semester_id'];
          $semester_name = $row['semester_name'];
          $selected = ($semester_id == $course['semester_id']) ? 'selected' : '';
          echo "<option value='$semester_id' $selected>$semester_name</option>";
        }
      }
      ?>
    </select><br><br>

    <input type="submit" name="submit" value="Update Course">
  </form>

  <?php
  if (isset($_POST['submit'])) {
    $new_course_code = $_POST['course_code'];
    $new_course_name = $_POST['course_name'];
    $new_credits = $_POST['credits'];
    $new_department_id = $_POST['department_id'];
    $new_semester_id = $_POST['semester_id'];

    // Update course details in the database
    $sql_update_course = "UPDATE Course SET course_code = '$new_course_code', course_name = '$new_course_name', credits = '$new_credits', department_id = '$new_department_id', semester_id = '$new_semester_id' WHERE course_id = '$course_id'";

    if ($conn->query($sql_update_course) === TRUE) {
      echo "<p>Course updated successfully!</p>";
    } else {
      echo "<p>Error updating course: " . $conn->error . "</p>";
    }
  }

  // Close the database connection
  $conn->close();
  ?>
</body>

</html>

</html>