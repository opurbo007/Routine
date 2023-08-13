<!DOCTYPE html>
<html>

<head>
  <title>Edit Semester</title>
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
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $semester_id = $_POST["semester_id"];
    $semester_name = $_POST["semester_name"];
    $department_id = $_POST["department_id"];

    // Update the semester in the Semester table
    $sql_update_semester = "UPDATE Semester SET semester_name = '$semester_name', department_id = $department_id WHERE semester_id = $semester_id";

    if ($conn->query($sql_update_semester) === TRUE) {
      echo "<p>Semester updated successfully!</p>";
    } else {
      echo "<p>Error updating semester: " . $conn->error . "</p>";
    }
  } else {
    // Retrieve the semester details
    $semester_id = $_GET["semester_id"];
    $sql_get_semester = "SELECT * FROM Semester WHERE semester_id = $semester_id";
    $result_get_semester = $conn->query($sql_get_semester);

    if ($result_get_semester->num_rows > 0) {
      $row = $result_get_semester->fetch_assoc();
      $semester_name = $row["semester_name"];
      $department_id = $row["department_id"];
    } else {
      echo "<p>Semester not found.</p>";
      exit();
    }
  }

  // Fetch departments for dropdown
  $sql_departments = "SELECT * FROM Department";
  $result_departments = $conn->query($sql_departments);
  ?>

  <h2>Edit Semester</h2>
  <form method="post">
    <input type="hidden" name="semester_id" value="<?php echo $semester_id; ?>">
    <label for="semester_name">Semester Name:</label>
    <input type="text" id="semester_name" name="semester_name" value="<?php echo $semester_name; ?>" required>
    <br><br>
    <label for="department_id">Select Department:</label>
    <select id="department_id" name="department_id" required>
      <?php
      if ($result_departments->num_rows > 0) {
        while ($row = $result_departments->fetch_assoc()) {
          $dept_id = $row['department_id'];
          $dept_name = $row['department_name'];
          $selected = ($dept_id == $department_id) ? 'selected' : '';
          echo "<option value='$dept_id' $selected>$dept_name</option>";
        }
      }
      ?>
    </select>
    <br><br>
    <input type="submit" value="Update Semester">
  </form>

  <?php
  // Close the database connection
  $conn->close();
  ?>
</body>

</html>