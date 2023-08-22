<!DOCTYPE html>
<html>

<head>
  <title>Selected Courses</title>
</head>

<body>

  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "routine";

  $connection = new mysqli($servername, $username, $password, $dbname);

  // Take batch, semester, and session info from previous page
  $selectedBatch = $_POST['batch'];
  $selectedSemester = $_POST['semester'];
  $selectedSession = $_POST['session'];

  // Fetch batch name
  $batchQuery = "SELECT batch_number FROM batch WHERE batch_id = ?";
  $batchStmt = $connection->prepare($batchQuery);
  $batchStmt->bind_param("i", $selectedBatch);
  $batchStmt->execute();
  $batchResult = $batchStmt->get_result();
  $batchRow = $batchResult->fetch_assoc();
  $selectedBatchName = $batchRow['batch_number'];

  // Fetch semester name
  $semesterQuery = "SELECT semester_name FROM semester WHERE semester_id = ?";
  $semesterStmt = $connection->prepare($semesterQuery);
  $semesterStmt->bind_param("i", $selectedSemester);
  $semesterStmt->execute();
  $semesterResult = $semesterStmt->get_result();
  $semesterRow = $semesterResult->fetch_assoc();
  $selectedSemesterName = $semesterRow['semester_name'];

  // Display batch, semester, and session info
  echo "<h2>Selected Batch: $selectedBatchName</h2>";
  echo "<h2>Selected Semester: $selectedSemesterName</h2>";
  echo "<h2>Selected Session: $selectedSession</h2>";

  // Display the form to generate the routine
  echo "<form action='generate_routine.php' method='post'>";
  echo "<input type='hidden' name='batch' value='$selectedBatch'>";
  echo "<input type='hidden' name='semester' value='$selectedSemester'>";
  echo "<input type='hidden' name='session' value='$selectedSession'>";

  // Fetch and display courses for the selected semester
  $courseQuery = "SELECT course_id, course_name, course_type FROM course WHERE semester_id = ?";
  $courseStmt = $connection->prepare($courseQuery);
  $courseStmt->bind_param("i", $selectedSemester);
  $courseStmt->execute();
  $courseResult = $courseStmt->get_result();

  while ($courseRow = $courseResult->fetch_assoc()) {
    echo "<h2>{$courseRow['course_name']}</h2>";

    echo "<div class='day-time-fields'>";
    foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $dayName) {
      echo "<div class='day-time-field'>";
      echo "<label for='{$courseRow['course_id']}_{$dayName}'>$dayName:</label>";
      echo "<input type='checkbox' name='day[{$courseRow['course_id']}][]' value='$dayName' id='{$courseRow['course_id']}_{$dayName}'>";

      $courseType = $courseRow['course_type'];

      // Fetch appropriate time slots based on course type
      $timetableTimeQuery = "SELECT DISTINCT start_time, end_time FROM timeslot WHERE class_type = ?";

      $timetableTimeStmt = $connection->prepare($timetableTimeQuery);
      $timetableTimeStmt->bind_param("s", $courseType);
      $timetableTimeStmt->execute();
      $timetableTimeResult = $timetableTimeStmt->get_result();

      echo "<select name='time[{$courseRow['course_id']}][$dayName]'>";
      while ($timetableTimeRow = $timetableTimeResult->fetch_assoc()) {
        $startTime = $timetableTimeRow['start_time'];
        $endTime = $timetableTimeRow['end_time'];
        echo "<option value='$startTime|$endTime'>$startTime - $endTime</option>";
      }
      echo "</select><br>";

      echo "</div>";
    }
    echo "</div>";


    // Fetch and display room options based on course type
    $roomQuery = "SELECT room_id, room_number, room_type FROM room WHERE room_type = ?";
    $roomType = ($courseType === 'theory') ? 'theory' : 'Lab';
    $roomStmt = $connection->prepare($roomQuery);
    $roomStmt->bind_param("s", $roomType);
    $roomStmt->execute();
    $roomResult = $roomStmt->get_result();

    echo "<label for='room'>Select Room:</label>";
    echo "<select name='room[{$courseRow['course_id']}]'>";
    while ($roomRow = $roomResult->fetch_assoc()) {
      echo "<option value='{$roomRow['room_id']}'>{$roomRow['room_number']}</option>";
    }
    echo "</select><br>";

    // Fetch and display teacher options based on the course
    $teacherCourseQuery = "SELECT teachers.teacher_id, teachers.name FROM teachers
                           INNER JOIN teachercourses ON teachers.teacher_id = teachercourses.teacher_id
                           WHERE teachercourses.course_id = ?";

    $teacherCourseStmt = $connection->prepare($teacherCourseQuery);
    $teacherCourseStmt->bind_param("i", $courseRow['course_id']);
    $teacherCourseStmt->execute();
    $teacherCourseResult = $teacherCourseStmt->get_result();

    echo "<label for='teacher'>Select Teacher:</label>";
    echo "<select name='teacher[{$courseRow['course_id']}]'>";
    while ($teacherRow = $teacherCourseResult->fetch_assoc()) {
      echo "<option value='{$teacherRow['teacher_id']}'>{$teacherRow['name']}</option>";
    }
    echo "</select><br>";
  }


  echo "<input type='submit' value='Generate Routine'>";
  echo "</form>";
  ?>
</body>

</html>