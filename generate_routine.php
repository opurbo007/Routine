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

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['day'])) {
    $selectedBatch = $_POST['batch'];
    $selectedSemester = $_POST['semester'];
    $selectedDays = $_POST['day'];
    $selectedTimes = $_POST['time'];
    // $selectedEndTimes = $_POST['end_time'];
    $selectedRooms = $_POST['room'];
    $selectedTeachers = $_POST['teacher'];

    foreach ($selectedDays as $courseId => $selectedDay) {
      $selectedTimeRange = explode("|", $selectedTimes[$courseId]);
      $selectedTime = $selectedTimeRange[0];
      $selectedEndTime = $selectedTimeRange[1];
      $selectedRoom = $selectedRooms[$courseId];
      $selectedTeacher = $selectedTeachers[$courseId];

      // Insert the data into the routine table
      $insertQuery = "INSERT INTO routine (batch, semester, course_id, day, start_time, end_time, room_id, teacher_id)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

      $insertStmt = $connection->prepare($insertQuery);
      $insertStmt->bind_param("ssisssii", $selectedBatch, $selectedSemester, $courseId, $selectedDay, $selectedTime, $selectedEndTime, $selectedRoom, $selectedTeacher);
      $insertStmt->execute();
    }

    echo "Routine generated successfully!";
  }
  ?>

</body>

</html>