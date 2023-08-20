<!DOCTYPE html>
<html>

<head>
  <title>Teacher Dashboard</title>
</head>

<body>

  <?php
  session_start();
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "routine";

  // Create a database connection
  $connection = new mysqli($servername, $username, $password, $dbname);

  // Check if the teacher is authenticated
  if (isset($_SESSION["teacher_id"])) {
    $teacherId = $_SESSION["teacher_id"];

    // Retrieve teacher's profile information from the database
    $query = "SELECT name, position, department_id, picture, mail, mobile FROM teachers WHERE teacher_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $teacherId);
    $stmt->execute();
    $result = $stmt->get_result();
    $teacher = $result->fetch_assoc();

    echo "<h1>Welcome, {$teacher['name']}!</h1>";

    // Display the teacher's profile information
    echo "<h2>Profile Information</h2>";
    echo "<p>Name: {$teacher['name']}</p>";
    echo "<p>Position: {$teacher['position']}</p>";

    // Fetch department name from the department table
    $departmentQuery = "SELECT department_name FROM department WHERE department_id = ?";
    $departmentStmt = $connection->prepare($departmentQuery);
    $departmentStmt->bind_param("i", $teacher["department_id"]);
    $departmentStmt->execute();
    $departmentResult = $departmentStmt->get_result();
    $departmentRow = $departmentResult->fetch_assoc();
    $departmentName = $departmentRow["department_name"];

    echo "<p>Department: {$departmentName}</p>";
    echo "<p>Email: {$teacher['mail']}</p>";
    echo "<p>Mobile: {$teacher['mobile']}</p>";

    // Display the teacher's profile picture if available
    if ($teacher['picture']) {
      echo "<p>Profile Picture:</p>";
      echo "<img src='../../../{$teacher['picture']}' alt='Profile Picture' width='150'>";
    }

    // Add code here to display the teacher's routine (if required)
  } else {
    echo "You are not authorized to view this page.";
  }

  // Close the database connection
  $connection->close();
  ?>

  <div>
    <a href="routine.php">View Routine</a>
  </div>

</body>

</html>