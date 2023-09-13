<?php
session_start();
include("../../../../database/config.php");

// Initialize an array to store unavailability messages
$unavailabilityMessages = [];

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
      $teacherAvailabilityQuery = "SELECT t.name AS teacher_name, c.course_name FROM routine r
                                    INNER JOIN teachers t ON r.teacher_id = t.teacher_id
                                    INNER JOIN course c ON r.course_id = c.course_id
                                    WHERE r.day = ? AND ((r.start_time <= ? AND r.end_time >= ?) OR (r.start_time <= ? AND r.end_time >= ?)) 
                                    AND r.teacher_id = ?";

      $teacherAvailabilityStmt = $conn->prepare($teacherAvailabilityQuery);
      $teacherAvailabilityStmt->bind_param("sssssi", $selectedDay, $selectedTime, $selectedTime, $selectedEndTime, $selectedEndTime, $selectedTeacher);
      $teacherAvailabilityStmt->execute();
      $teacherAvailabilityResult = $teacherAvailabilityStmt->get_result();

      $roomAvailabilityQuery = "SELECT ro.room_number FROM routine r
      INNER JOIN room ro ON r.room_id = ro.room_id
      WHERE r.day = ? AND ((r.start_time <= ? AND r.end_time >= ?) OR (r.start_time <= ? AND r.end_time >= ?)) 
      AND r.room_id = ?";


      $roomAvailabilityStmt = $conn->prepare($roomAvailabilityQuery);
      $roomAvailabilityStmt->bind_param("sssssi", $selectedDay, $selectedTime, $selectedTime, $selectedEndTime, $selectedEndTime, $selectedRoom);
      $roomAvailabilityStmt->execute();
      $roomAvailabilityResult = $roomAvailabilityStmt->get_result();

      $teacherUnavailable = ($teacherAvailabilityResult->num_rows > 0);
      $roomUnavailable = ($roomAvailabilityResult->num_rows > 0);

      // Fetch the teacher's name using the $selectedTeacher (teacher ID)
      $teacherNameQuery = "SELECT name FROM teachers WHERE teacher_id = ?";
      $teacherNameStmt = $conn->prepare($teacherNameQuery);
      $teacherNameStmt->bind_param("i", $selectedTeacher);
      $teacherNameStmt->execute();
      $teacherNameResult = $teacherNameStmt->get_result();

      if ($teacherNameResult->num_rows > 0) {
        $teacherData = $teacherNameResult->fetch_assoc();
        $teacherName = $teacherData['name'];
      } else {
        $teacherName = "Unknown Teacher";
      }

      // Fetch the room number using the $selectedRoom (room ID)
      $roomNumberQuery = "SELECT room_number FROM room WHERE room_id = ?";
      $roomNumberStmt = $conn->prepare($roomNumberQuery);
      $roomNumberStmt->bind_param("i", $selectedRoom);
      $roomNumberStmt->execute();
      $roomNumberResult = $roomNumberStmt->get_result();

      if ($roomNumberResult->num_rows > 0) {
        $roomData = $roomNumberResult->fetch_assoc();
        $roomNumber = $roomData['room_number'];
      } else {
        $roomNumber = "Unknown Room";
      }

      // Generate the error message
      if ($teacherUnavailable && $roomUnavailable) {
        $unavailabilityMessages[] = "Error! Teacher ($teacherName) and Room ($roomNumber) are not available for this time slot on $selectedDay at $selectedTime - $selectedEndTime.";
      } elseif ($teacherUnavailable) {
        $unavailabilityMessages[] = "Error! Teacher ($teacherName) is not available for this time slot on $selectedDay at $selectedTime - $selectedEndTime.";
      } elseif ($roomUnavailable) {
        $unavailabilityMessages[] = "Error! Room ($roomNumber) is not available for this time slot on $selectedDay at $selectedTime - $selectedEndTime.";
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
        $insertStmt->execute();

        if ($insertStmt->affected_rows > 0) {
          $_SESSION['success_message'] = "Successfully Routine Generated";
        } else {
          $_SESSION['error_message'] = "Error! Something went wrong";
        }
      }
    }
  }
}

// Store the unavailability messages in the session
if (!empty($unavailabilityMessages)) {
  $_SESSION['unavailability_messages'] = $unavailabilityMessages;
}

header('Location: select.php');
exit;
?>