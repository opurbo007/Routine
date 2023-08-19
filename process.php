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
  //take batch info
  $selectedBatch = $_POST['batch'];
  $selectedSemester = $_POST['semester'];

  $batchQuery = "SELECT batch_number FROM batch WHERE batch_id = ?";
  $batchStmt = $connection->prepare($batchQuery);
  $batchStmt->bind_param("i", $selectedBatch);
  $batchStmt->execute();
  $batchResult = $batchStmt->get_result();
  $batchRow = $batchResult->fetch_assoc();
  $selectedBatchName = $batchRow['batch_number'];
  //take semester info
  $semesterQuery = "SELECT semester_name FROM semester WHERE semester_id = ?";
  $semesterStmt = $connection->prepare($semesterQuery);
  $semesterStmt->bind_param("i", $selectedSemester);
  $semesterStmt->execute();
  $semesterResult = $semesterStmt->get_result();
  $semesterRow = $semesterResult->fetch_assoc();
  $selectedSemesterName = $semesterRow['semester_name'];
  //form to generate routine
  
  echo "<form action='generate_routine.php' method='post'>";

  echo "<input type='hidden' name='batch' value='$selectedBatch'>";
  echo "<input type='hidden' name='semester' value='$selectedSemester'>";

  echo "<p>Selected Batch: $selectedBatchName</p>";
  echo "<p>Selected Semester: $selectedSemesterName</p>";
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
      echo "<option value='$startTime|$endTime'>$startTime - $endTime</option>";
    }

    echo "</select><br>";

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