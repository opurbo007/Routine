<!DOCTYPE html>
<html>

<head>
  <title>Teachers Management</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
  <h2>Teachers Management</h2>

  <!-- Search Form -->
  <form method="get">
    <label for="search">Search by Name or Mobile:</label>
    <input type="text" id="search" name="search">
    <input type="submit" value="Search">
  </form>

  <!-- Teacher List -->

  <table>
    <tr>
      <th>Name</th>
      <th>Mobile</th>
      <th>Department</th>
      <th>Position</th>
      <th>Mail</th>
      <th>Courses</th> <!-- New column for courses dropdown -->
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

    // Retrieve teachers from the database based on search query
    $search = $_GET['search'] ?? '';
    $sql = "SELECT Teachers.*, department_name, GROUP_CONCAT(CONCAT(Course.course_code, ' - ', Course.course_name) SEPARATOR ', ') AS courses
            FROM Teachers
            INNER JOIN department ON Teachers.department_id = department.department_id
            LEFT JOIN TeacherCourses ON Teachers.teacher_id = TeacherCourses.teacher_id
            LEFT JOIN Course ON TeacherCourses.course_id = Course.course_id
            WHERE Teachers.name LIKE '%$search%' OR Teachers.mobile LIKE '%$search%'
            GROUP BY Teachers.teacher_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<tr>
                  <td><img src='../add/{$row['picture']}' width='50' height='50'></td>
                  <td>{$row['name']}</td>
                  <td>{$row['mobile']}</td>
                  <td>{$row['department_name']}</td>
                  <td>{$row['position']}</td>
                  <td>
                    <select>";
        // Display chosen courses (code and name) as options in dropdown
        $courses = explode(', ', $row['courses']);
        foreach ($courses as $course) {
          echo "<option value='$course'>$course</option>";
        }
        echo "</select>
                  </td>
                  <td>{$row['mail']}</td>
                  <td>
                      <a href='edit_teacher.php?id={$row['teacher_id']}'>Edit</a> |
                      <a href='delete_teacher.php?id={$row['teacher_id']}'>Delete</a>
                  </td>
              </tr>";
      }
    } else {
      echo "<tr><td colspan='8'>No teachers found.</td></tr>";
    }

    // Close the database connection
    $conn->close();
    ?>
  </table>



  <p><a href="add_teacher.php">Add New Teacher</a></p>
</body>

</html>