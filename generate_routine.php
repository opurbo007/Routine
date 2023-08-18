<!DOCTYPE html>
<html>

<head>
  <title>Generated Routine</title>
</head>

<body>
  <h1>Generated Routine</h1>

  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "routine";

  $connection = new mysqli($servername, $username, $password, $dbname);

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dayData = $_POST['day'];
    $timeData = $_POST['time'];
    $roomData = $_POST['room'];
    $teacherData = $_POST['teacher'];

    foreach ($dayData as $courseId => $selectedDay) {
      $selectedTime = $timeData[$courseId];
      $selectedRoom = $roomData[$courseId];
      $selectedTeacher = $teacherData[$courseId];

      // Perform database insert here using the routine table
      // Example query (replace with your actual table name and columns):
      $insertQuery = "INSERT INTO routine (course_id, day, time, room_id, teacher_id) VALUES (?, ?, ?, ?, ?)";
      $insertStmt = $connection->prepare($insertQuery);
      $insertStmt->bind_param("isssi", $courseId, $selectedDay, $selectedTime, $selectedRoom, $selectedTeacher);
      $insertStmt->execute();
    }

    echo "Routine generated and stored in the database.";
  }
  ?>
</body>

</html>