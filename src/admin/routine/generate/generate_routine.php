<?php
session_start();
include("../../../../database/config.php");


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

      // Check room and teacher availability
      $availabilityQuery = "SELECT * FROM routine WHERE day = ? AND ((start_time <= ? AND end_time >= ?) OR (start_time <= ? AND end_time >= ?)) AND (room_id = ? OR teacher_id = ?)";

      $availabilityStmt = $conn->prepare($availabilityQuery);
      $availabilityStmt->bind_param("ssssssi", $selectedDay, $selectedTime, $selectedTime, $selectedEndTime, $selectedEndTime, $selectedRoom, $selectedTeacher);
      $availabilityStmt->execute();
      $availabilityResult = $availabilityStmt->get_result();

      if ($availabilityResult->num_rows > 0) {
        $row = $availabilityResult->fetch_assoc();
        $unavailableResource = $row['teacher_id'] == $selectedTeacher ? 'Teacher' : 'Room';
        $_SESSION['error_message'] = "Error! $unavailableResource is not available at this time.";

        header('Location: select.php');
        exit;

      } else {
        // Insert the data into the routine table
        $insertQuery = "INSERT INTO routine (batch, semester, session, course_id, day, start_time, end_time, room_id, teacher_id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $insertStmt = $conn->prepare($insertQuery);
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
        $insertStmt->execute(); // Execute the prepared statement

        if ($insertStmt->affected_rows > 0) {
          $_SESSION['success_message'] = "Successfully Routine Generated";
        } else {
          $_SESSION['error_message'] = "Error! Something went wrong";
        }


      }
    }
  }


}


header('Location: select.php');
exit;

?>