<!DOCTYPE html>
<html>

<head>
  <title>Departments</title>
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

  // Handle department deletion
  if (isset($_GET["delete"])) {
    $delete_id = $_GET["delete"];
    $sql_delete_department = "DELETE FROM Department WHERE department_id = $delete_id";
    $conn->query($sql_delete_department);
  }

  // Handle department update
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $update_id = $_POST["update_id"];
    $updated_department_name = $_POST["updated_department_name"];
    $sql_update_department = "UPDATE Department SET department_name = '$updated_department_name' WHERE department_id = $update_id";
    $conn->query($sql_update_department);
  }

  // Handle the search functionality
  $search_result = [];
  if (isset($_GET["search"])) {
    $search_query = $_GET["search"];
    $sql_search_department = "SELECT * FROM Department WHERE department_name LIKE '%$search_query%'";
    $result_search_department = $conn->query($sql_search_department);

    if ($result_search_department->num_rows > 0) {
      while ($row = $result_search_department->fetch_assoc()) {
        $search_result[] = $row;
      }
    }
  } else {
    // Fetch all departments
    $sql_fetch_departments = "SELECT * FROM Department";
    $result_fetch_departments = $conn->query($sql_fetch_departments);

    if ($result_fetch_departments->num_rows > 0) {
      while ($row = $result_fetch_departments->fetch_assoc()) {
        $search_result[] = $row;
      }
    }
  }
  ?>

  <h2>Departments</h2>

  <!-- Search form -->
  <form method="get">
    <input type="text" name="search" placeholder="Search by department name">
    <input type="submit" value="Search">
  </form>

  <!-- Display departments -->
  <table border="1">
    <tr>
      <th>Department ID</th>
      <th>Department Name</th>
      <th>Actions</th>
    </tr>
    <?php foreach ($search_result as $department) { ?>
      <tr>
        <td>
          <?php echo $department["department_id"]; ?>
        </td>
        <td>
          <?php echo $department["department_name"]; ?>
        </td>
        <td>
          <a href="edit_dept.php?id=<?php echo $department["department_id"]; ?>">Edit</a>
          <a href="dept.php?delete=<?php echo $department["department_id"]; ?>"
            onclick="return confirm('Are you sure you want to delete this department?')">Delete</a>
        </td>
      </tr>
    <?php } ?>
  </table>

  <?php
  // Close the database connection
  $conn->close();
  ?>
</body>

</html>