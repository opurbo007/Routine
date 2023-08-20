<!DOCTYPE html>
<html>

<head>
  <title>Course Management</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
  <h2>Course Management</h2>

  <!-- Search Form -->
  <form method="get">
    <label for="search">Search:</label>
    <input type="text" id="search" name="search">
    <input type="submit" value="Search">
  </form>

  <!-- Course List -->
  <table>
    <tr>
      <th>Course Code</th>
      <th>Course Name</th>
      <th>Credits</th>
      <th>Department</th> <!-- New column for Department -->
      <th>Semester</th> <!-- New column for Semester -->
      <th>Actions</th>
    </tr>
    <?php
    // Include your database connection code here
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

    // Retrieve courses with department and semester information from the database based on search query
    $search = $_GET['search'] ?? '';
    $sql = "SELECT Course.*, department_name, semester_name FROM Course
            INNER JOIN department ON Course.department_id = department.department_id
            INNER JOIN Semester ON Course.semester_id = Semester.semester_id
            WHERE course_code LIKE '%$search%'
            OR course_name LIKE '%$search%'
            OR department_name LIKE '%$search%'
            OR semester_name LIKE '%$search%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<tr>
                          <td>{$row['course_code']}</td>
                          <td>{$row['course_name']}</td>
                          <td>{$row['credits']}</td>
                          <td>{$row['department_name']}</td>
                          <td>{$row['semester_name']}</td>
                          <td>
                              <a href='edit_course.php?id={$row['course_id']}'>Edit</a> |
                              <a href='delete_course.php?id={$row['course_id']}'>Delete</a>
                          </td>
                      </tr>";
      }
    } else {
      echo "<tr><td colspan='6'>No courses found.</td></tr>";
    }

    // Close the database connection
    $conn->close();
    ?>
  </table>

  <p><a href="add_course.php">Add New Course</a></p>
</body>

</html>