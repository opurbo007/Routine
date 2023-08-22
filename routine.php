<!DOCTYPE html>
<html>

<head>
  <title>Generated Routine</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      margin-bottom: 30px;
    }

    th,
    td {
      border: 1px solid black;
      padding: 8px;
      text-align: center;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>
  <h1>Generated Routine</h1>

  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "routine";

  $connection = new mysqli($servername, $username, $password, $dbname);

  // Fetch the generated routine based on batch, semester, and session
  $selectedBatch = $_POST['batch'];
  $selectedSemester = $_POST['semester'];
  $selectedSession = $_POST['session'];

  $routineQuery = "SELECT course.course_code, course.course_name, day, start_time, end_time, room_number, name FROM routine
                 INNER JOIN course ON routine.course_id = course.course_id
                 INNER JOIN room ON routine.room_id = room.room_id
                 INNER JOIN teachers ON routine.teacher_id = teachers.teacher_id
                 WHERE batch = ? AND semester = ? AND session = ?"; // Adding session condition
  
  $routineStmt = $connection->prepare($routineQuery);
  $routineStmt->bind_param("iis", $selectedBatch, $selectedSemester, $selectedSession); // Adding session parameter
  $routineStmt->execute();
  $routineResult = $routineStmt->get_result();

  echo "<table>";
  echo "<tr><th>Day & Time</th>";

  $timeSlotsToShow = array(); // Store time slots that have at least one class scheduled
  // Fetch the distinct time slots from the timeslot table
  $timeSlotQuery = "SELECT DISTINCT start_time, end_time FROM timeslot";
  $timeSlotResult = $connection->query($timeSlotQuery);
  $timeSlots = array();
  while ($row = $timeSlotResult->fetch_assoc()) {
    $timeSlots[] = $row;
  }

  foreach ($timeSlots as $timeSlot) {
    $found = false;
    while ($row = $routineResult->fetch_assoc()) {
      if ($row['start_time'] == $timeSlot['start_time'] && $row['end_time'] == $timeSlot['end_time']) {
        $found = true;
        break;
      }
    }

    if ($found) {
      $startTime = date("H:i", strtotime($timeSlot['start_time']));
      $endTime = date("H:i", strtotime($timeSlot['end_time']));
      echo "<th colspan='3'>$startTime - $endTime</th>";
      $timeSlotsToShow[] = $timeSlot;
    }
  }

  echo "</tr>";



  $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

  foreach ($days as $day) {
    echo "<tr>";
    echo "<td>$day</td>";

    foreach ($timeSlotsToShow as $timeSlot) {
      echo "<td colspan='3'>";

      $routineResult->data_seek(0);
      $found = false;
      while ($row = $routineResult->fetch_assoc()) {
        if ($row['day'] == $day && $row['start_time'] == $timeSlot['start_time'] && $row['end_time'] == $timeSlot['end_time']) {
          echo "{$row['course_code']}<br>{$row['course_name']}<br><b>{$row['name']}</b><br>({$row['room_number']})<br>";
          $found = true;
          // Add an "Edit" button
          echo "<form action='edit_routine.php' method='get'>";
          echo "<input type='hidden' name='batch' value='$selectedBatch'>";
          echo "<input type='hidden' name='semester' value='$selectedSemester'>";
          echo "<input type='hidden' name='session' value='$selectedSession'>";
          echo "<input type='hidden' name='day' value='$day'>";
          echo "<input type='hidden' name='start_time' value='{$timeSlot['start_time']}'>";
          echo "<input type='hidden' name='end_time' value='{$timeSlot['end_time']}'>";
          echo "<input type='submit' value='Edit'>";
          echo "</form>";


        }
      }

      if (!$found) {
        echo "Off day";
      }

      echo "</td>";
    }

    echo "</tr>";
  }

  echo "</table>";

  ?>

</body>

</html>