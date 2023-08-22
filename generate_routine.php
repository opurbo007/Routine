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
    $selectedRooms = $_POST['room'];
    $selectedTeachers = $_POST['teacher'];
    $selectedSession = $_POST['session'];



    foreach ($selectedDays as $courseId => $days) {
      foreach ($days as $selectedDay) {
        $selectedTimeRange = explode("|", $selectedTimes[$courseId][$selectedDay]);
        $selectedTime = $selectedTimeRange[0];
        $selectedEndTime = $selectedTimeRange[1];
        $selectedRoom = $selectedRooms[$courseId];
        $selectedTeacher = $selectedTeachers[$courseId];

        // Insert the data into the routine table
        $insertQuery = "INSERT INTO routine (batch, semester, session, course_id, day, start_time, end_time, room_id, teacher_id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $insertStmt = $connection->prepare($insertQuery);
        $insertStmt->bind_param(
          "iissssssi",
          $selectedBatch,
          $selectedSemester,
          $selectedSession,
          $courseId,
          $selectedDay,
          $selectedTime,
          $selectedEndTime,
          $selectedRoom,
          $selectedTeacher
        );
        $insertStmt->execute();


      }
    }

    echo "Routine generated successfully!";

    echo "$selectedSession";

  }
  ?>

</body>

</html>