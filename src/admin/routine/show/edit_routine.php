<!DOCTYPE html>
<html>

<head>
  <title>Edit Routine</title>
</head>

<body>
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "routine";

  $connection = new mysqli($servername, $username, $password, $dbname);

  if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
  }

  // Get the routine_id from the URL parameter
  $routineId = $_GET['routine_id'];

  // Fetch routine data based on the routine_id
  $query = "SELECT routine.*, course.course_name FROM routine
            INNER JOIN course ON routine.course_id = course.course_id
            WHERE routine_id = ?";
  $stmt = $connection->prepare($query);
  $stmt->bind_param("i", $routineId);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  // Display the edit form with pre-filled values
  echo "<form action='update_routine.php' method='post'>";
  echo "<input type='hidden' name='routine_id' value='$routineId'>";

  // Display the course name
  echo "<label for='course_name'>Course Name:</label>";
  echo "<input type='text' name='course_name' value='{$row['course_name']}' readonly><br>";


  // Display dropdown for selecting day
  echo "<label for='new_day'>Select Day:</label>";
  echo "<select name='new_day'>";
  foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $dayName) {
    $isSelected = ($dayName === $row['day']) ? "selected" : "";
    echo "<option value='$dayName' $isSelected>$dayName</option>";
  }
  echo "</select><br>";

  // Fetch the course type for the selected course
  $courseTypeQuery = "SELECT course_type FROM course WHERE course_id = ?";
  $courseTypeStmt = $connection->prepare($courseTypeQuery);
  $courseTypeStmt->bind_param("i", $row['course_id']);
  $courseTypeStmt->execute();
  $courseTypeResult = $courseTypeStmt->get_result();
  $courseTypeRow = $courseTypeResult->fetch_assoc();
  $courseType = $courseTypeRow['course_type'];

  // Display time slot dropdown based on course type
  echo "<label for='new_time'>Select Time Slot:</label>";
  echo "<select name='new_time'>";
  echo "<option value=''>Select Time Slot</option>";
  $timetableTimeQuery = "SELECT DISTINCT start_time, end_time FROM timeslot WHERE class_type = ?";
  $timetableTimeStmt = $connection->prepare($timetableTimeQuery);
  $timetableTimeStmt->bind_param("s", $courseType);
  $timetableTimeStmt->execute();
  $timetableTimeResult = $timetableTimeStmt->get_result();
  while ($timetableTimeRow = $timetableTimeResult->fetch_assoc()) {
    $timeSlot = $timetableTimeRow['start_time'] . '|' . $timetableTimeRow['end_time'];
    $isSelected = ($timeSlot === $row['start_time'] . '|' . $row['end_time']) ? "selected" : "";
    echo "<option value='$timeSlot' $isSelected>{$timetableTimeRow['start_time']} - {$timetableTimeRow['end_time']}</option>";
  }
  echo "</select><br>";

  // Display room dropdown based on course type
  echo "<label for='new_room'>Select Room:</label>";
  echo "<select name='new_room'>";
  echo "<option value=''>Select Room</option>";
  $roomQuery = "SELECT room_id, room_number FROM room WHERE room_type = ?";
  $roomStmt = $connection->prepare($roomQuery);
  $roomStmt->bind_param("s", $courseType);
  $roomStmt->execute();
  $roomResult = $roomStmt->get_result();
  while ($roomRow = $roomResult->fetch_assoc()) {
    $isSelected = ($roomRow['room_id'] === $row['room_id']) ? "selected" : "";
    echo "<option value='{$roomRow['room_id']}' $isSelected>{$roomRow['room_number']}</option>";
  }
  echo "</select><br>";

  // Display teacher dropdown based on the selected course
  echo "<label for='new_teacher'>Select Teacher:</label>";
  echo "<select name='new_teacher'>";
  echo "<option value=''>Select Teacher</option>";
  $teacherCourseQuery = "SELECT teachers.teacher_id, teachers.name FROM teachers
                         INNER JOIN teachercourses ON teachers.teacher_id = teachercourses.teacher_id
                         WHERE teachercourses.course_id = ?";
  $teacherCourseStmt = $connection->prepare($teacherCourseQuery);
  $teacherCourseStmt->bind_param("i", $row['course_id']);
  $teacherCourseStmt->execute();
  $teacherCourseResult = $teacherCourseStmt->get_result();
  while ($teacherRow = $teacherCourseResult->fetch_assoc()) {
    $isSelected = ($teacherRow['teacher_id'] === $row['teacher_id']) ? "selected" : "";
    echo "<option value='{$teacherRow['teacher_id']}' $isSelected>{$teacherRow['name']}</option>";
  }
  echo "</select><br>";

  // Submit button
  echo "<input type='submit' value='Update Routine'>";
  echo "</form>";

  ?>
</body>

</html>