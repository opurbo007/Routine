<!DOCTYPE html>
<html>

<head>
  <title>Edit Department</title>
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

  $department_id = $_GET["id"];

  // Fetch department details
  $sql_fetch_department = "SELECT * FROM Department WHERE department_id = $department_id";
  $result_fetch_department = $conn->query($sql_fetch_department);

  $department_name = "";
  if ($result_fetch_department->num_rows > 0) {
    $row = $result_fetch_department->fetch_assoc();
    $department_name = $row["department_name"];
  }

  // Handle the form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updated_department_name = $_POST["updated_department_name"];
    $sql_update_department = "UPDATE Department SET department_name = '$updated_department_name' WHERE department_id = $department_id";
    $conn->query($sql_update_department);

    header("Location: dept.php");
  }
  ?>

  <h2>Edit Department</h2>
  <form method="post">
    <input type="hidden" name="update_id" value="<?php echo $department_id; ?>">
    <label for="updated_department_name">Department Name:</label>
    <input type="text" id="updated_department_name" name="updated_department_name"
      value="<?php echo $department_name; ?>" required>
    <br><br>
    <input type="submit" value="Update Department">
  </form>

  <?php
  // Close the database connection
  $conn->close();
  ?>
</body>

</html>