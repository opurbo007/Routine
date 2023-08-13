<!DOCTYPE html>
<html>

<head>
  <title>Semesters</title>
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

  // Handle delete action
  if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['semester_id'])) {
    $semester_id = $_GET['semester_id'];

    // Delete the semester from the Semester table
    $sql_delete_semester = "DELETE FROM Semester WHERE semester_id = $semester_id";

    if ($conn->query($sql_delete_semester) === TRUE) {
      echo "<p>Semester deleted successfully!</p>";
    } else {
      echo "<p>Error deleting semester: " . $conn->error . "</p>";
    }
  }
  ?>

  <h2>Semesters</h2>
  <a href="../add/add_semester.php">Add Semester</a>

  <form action="" method="get" class="mt-4">
    <label for="search_department">Search by Department:</label>
    <select id="search_department" name="search_department">
      <option value="">All Departments</option>
      <?php
      // Fetch departments for dropdown
      $sql_departments = "SELECT * FROM Department";
      $result_departments = $conn->query($sql_departments);

      if ($result_departments->num_rows > 0) {
        while ($row = $result_departments->fetch_assoc()) {
          $department_id = $row['department_id'];
          $department_name = $row['department_name'];
          $selected = ($_GET['search_department'] == $department_id) ? 'selected' : '';
          echo "<option value='$department_id' $selected>$department_name</option>";
        }
      }
      ?>
    </select>
    <input type="submit" value="Search">
  </form>

  <table class="mt-4" border="1">
    <thead>
      <tr>
        <th>Semester Name</th>
        <th>Department</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $search_department = $_GET['search_department'] ?? '';

      $sql_semesters = "SELECT Semester.*, Department.department_name FROM Semester
                             LEFT JOIN Department ON Semester.department_id = Department.department_id";

      if (!empty($search_department)) {
        $sql_semesters .= " WHERE Semester.department_id = $search_department";
      }

      $result_semesters = $conn->query($sql_semesters);

      if ($result_semesters->num_rows > 0) {
        while ($row = $result_semesters->fetch_assoc()) {
          $semester_id = $row['semester_id'];
          $semester_name = $row['semester_name'];
          $department_name = $row['department_name'];

          echo "<tr>";
          echo "<td>$semester_name</td>";
          echo "<td>$department_name</td>";
          echo "<td>
                            <a href='edit_semester.php?action=edit&semester_id=$semester_id'>Edit</a>
                            <a href='semester.php?action=delete&semester_id=$semester_id'>Delete</a>
                          </td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='3'>No semesters found.</td></tr>";
      }
      ?>
    </tbody>
  </table>

  <?php
  // Close the database connection
  $conn->close();
  ?>
</body>

</html>