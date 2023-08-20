<!DOCTYPE html>
<html>

<head>
  <title>Your Routine</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    table {
      border-collapse: collapse;
      width: 100%;
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

  <?php
  // Start a new or resume an existing session
  session_start();

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "routine";

  // Create a database connection
  $connection = new mysqli($servername, $username, $password, $dbname);

  // Fetch time slots from the database
  $timeSlotsQuery = "SELECT DISTINCT TIME_FORMAT(start_time, '%h:%i') AS start_time, TIME_FORMAT(end_time, '%h:%i') AS end_time FROM timeslot ORDER BY start_time";
  $timeSlotsResult = $connection->query($timeSlotsQuery);
  $timeSlots = [];
  while ($row = $timeSlotsResult->fetch_assoc()) {
    $timeSlots[] = "{$row['start_time']} - {$row['end_time']}";
  }

  // Fetch and display the teacher's routine
  if (isset($_SESSION["teacher_id"])) {
    $teacherId = $_SESSION["teacher_id"];
    $routineQuery = "SELECT day, TIME_FORMAT(start_time, '%h:%i') AS start_time, TIME_FORMAT(end_time, '%h:%i') AS end_time, course_code, course_name, room_number
                     FROM routine
                     INNER JOIN course ON routine.course_id = course.course_id
                     INNER JOIN room ON routine.room_id = room.room_id
                     WHERE teacher_id = ?
                     ORDER BY FIELD(day, 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'), start_time";
    $routineStmt = $connection->prepare($routineQuery);
    $routineStmt->bind_param("i", $teacherId);
    $routineStmt->execute();
    $routineResult = $routineStmt->get_result();

    echo "<h2>Your Routine</h2>";
    echo "<table>";
    echo "<tr><th>Day & Time</th>";

    $columnsToDisplay = [];

    foreach ($timeSlots as $timeSlot) {
      $found = false;

      $routineResult->data_seek(0);
      while ($row = $routineResult->fetch_assoc()) {
        if ("{$row['start_time']} - {$row['end_time']}" == $timeSlot) {
          $found = true;
          break;
        }
      }

      if ($found) {
        echo "<th>{$timeSlot}</th>";
        $columnsToDisplay[] = $timeSlot;
      }
    }

    echo "</tr>";

    $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

    foreach ($days as $day) {
      echo "<tr>";
      echo "<td>{$day}</td>";

      foreach ($columnsToDisplay as $timeSlot) {
        $classes = [];

        $routineResult->data_seek(0);
        while ($row = $routineResult->fetch_assoc()) {
          if ($row['day'] == $day && "{$row['start_time']} - {$row['end_time']}" == $timeSlot) {
            $classes[] = "{$row['course_code']}<br>{$row['course_name']}<br>{$row['room_number']}";
          }
        }

        if (empty($classes)) {
          echo "<td>Off day</td>";
        } else {
          echo "<td>";
          foreach ($classes as $class) {
            echo "{$class}<br>";
          }
          echo "</td>";
        }
      }

      echo "</tr>";
    }

    echo "</table>";
  } else {
    echo "You are not authorized to view this page.";
  }

  // Close the database connection
  $connection->close();
  ?>

</body>

</html>