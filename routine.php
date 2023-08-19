<!DOCTYPE html>
<html>

<head>
  <title>Generated Routine</title>
  <style>
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
  <h1>Generated Routine</h1>

  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "routine";

  $connection = new mysqli($servername, $username, $password, $dbname);

  // Fetch the generated routine based on batch and semester
  $selectedBatch = $_POST['batch'];
  $selectedSemester = $_POST['semester'];

  $routineQuery = "SELECT course.course_code, course.course_name, day,  start_time, end_time, room_number, name FROM routine
                   INNER JOIN course ON routine.course_id = course.course_id
                   INNER JOIN room ON routine.room_id = room.room_id
                   INNER JOIN teachers ON routine.teacher_id = teachers.teacher_id
                   WHERE batch = ? AND semester = ?";

  $routineStmt = $connection->prepare($routineQuery);
  $routineStmt->bind_param("ii", $selectedBatch, $selectedSemester);
  $routineStmt->execute();
  $routineResult = $routineStmt->get_result();

  echo "<table>";
  echo "<tr><th>Course Code</th><th>Course Name</th><th>Day</th><th>Time</th><th>Room</th><th>Teacher</th></tr>";

  while ($row = $routineResult->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$row['course_code']}</td>";
    echo "<td>{$row['course_name']}</td>";
    echo "<td>{$row['day']}</td>";

    echo "<td>{$row['start_time']} - {$row['end_time']}</td>";
    echo "<td>{$row['room_number']}</td>";
    echo "<td>{$row['name']}</td>";
    echo "</tr>";
  }

  echo "</table>";

  ?>

</body>

</html>