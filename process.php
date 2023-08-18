<!DOCTYPE html>
<html>

<head>
  <title>Selected Courses</title>
</head>

<body>
  <h1>Selected Courses</h1>

  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "routine";

  $connection = new mysqli($servername, $username, $password, $dbname);

  $selectedBatch = $_POST['batch'];
  $selectedSemester = $_POST['semester'];

  echo "<form action='generate_routine.php' method='post'>";

  // Fetch and display courses for the selected semester
  $courseQuery = "SELECT course_id, course_name, course_type FROM course WHERE semester_id = ?";
  $courseStmt = $connection->prepare($courseQuery);
  $courseStmt->bind_param("i", $selectedSemester);
  $courseStmt->execute();
  $courseResult = $courseStmt->get_result();

  // Fetch days from the days table
  $daysQuery = "SELECT day_name FROM days";
  $daysResult = $connection->query($daysQuery);
  $dayOptions = "";
  while ($daysRow = $daysResult->fetch_assoc()) {
    $dayName = $daysRow['day_name'];
    $dayOptions .= "<option value='$dayName'>$dayName</option>";
  }

  while ($courseRow = $courseResult->fetch_assoc()) {
    echo "<h2>{$courseRow['course_name']}</h2>";
    echo "<label for='day'>Select Day:</label>";
    echo "<select name='day[{$courseRow['course_id']}]'>$dayOptions</select><br>";

    $courseType = $courseRow['course_type'];

    // Fetch appropriate time slots based on course type
    $timetableTimeQuery = "SELECT DISTINCT start_time, end_time FROM timeslot WHERE class_type = ?";

    $timetableTimeStmt = $connection->prepare($timetableTimeQuery);
    $timetableTimeStmt->bind_param("s", $courseType);
    $timetableTimeStmt->execute();
    $timetableTimeResult = $timetableTimeStmt->get_result();

    echo "<label for='time'>Select Time:</label>";
    echo "<select name='time[{$courseRow['course_id']}]'>";
    while ($timetableTimeRow = $timetableTimeResult->fetch_assoc()) {
      $startTime = $timetableTimeRow['start_time'];
      $endTime = $timetableTimeRow['end_time'];
      echo "<option value='$startTime'>$startTime - $endTime</option>";
    }
    echo "</select><br>";
    // Fetch and display teacher options
    $teacherQuery = "SELECT teacher_id, name FROM teachers WHERE department_id = ?";
    $teacherStmt = $connection->prepare($teacherQuery);
    // Replace with the actual department_id
    $departmentId = 1;
    $teacherStmt->bind_param("i", $departmentId);
    $teacherStmt->execute();
    $teacherResult = $teacherStmt->get_result();
    echo "<label for='teacher'>Select Teacher:</label>";
    echo "<select name='teacher[{$courseRow['course_id']}]'>";
    while ($teacherRow = $teacherResult->fetch_assoc()) {
      echo "<option value='{$teacherRow['teacher_id']}'>{$teacherRow['name']}</option>";
    }
    echo "</select><br>";
  }

  echo "<input type='submit' value='Generate Routine'>";
  echo "</form>";
  ?>
</body>

</html>