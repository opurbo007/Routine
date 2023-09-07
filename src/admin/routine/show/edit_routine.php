<?php

session_start();
ob_start();

include("../../../../database/config.php");
include("../../../include/adminNavbar.php");


?>
<div class="flex flex-col min-h-screen w-full">

  <?php

  // Get the routine_id from the URL parameter
  $routineId = $_GET['routine_id'];

  // Fetch routine data based on the routine_id
  $query = "SELECT routine.*, course.course_name FROM routine
            INNER JOIN course ON routine.course_id = course.course_id
            WHERE routine_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $routineId);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  ?>
  <div class="flex items-center justify-center flex-grow-2">

    <div
      class="relative mx-auto w-full max-w-md bg-white px-6 pt-10 mt-24 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:rounded-xl sm:px-10">
      <div class="w-full">
        <div class="text-center">
          <h1 class="text-2xl font-semibold text-gray-900">Update Cell</h1>
        </div>
        <div class="mt-5">

          <form action='update_routine.php' method='post'>

            <input type='hidden' name='routine_id' value='<?php echo $routineId; ?>'>
            <div class="relative mt-6">
              <label for='course_name' class="block text-sm font-medium text-gray-700">Course Name:</label>
              <input type='text' name='course_name' value='<?php echo $row['course_name']; ?>' readonly
                class="mt-1 p-2 block w-full rounded-md bg-gray-100 border border-gray-300">
            </div>
            <div class="relative mt-6">
              <label for='new_day'>Select Day:</label>
              <select name='new_day'
                class="w-full text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-gray-300">

                <?php
                foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $dayName) {
                  $isSelected = ($dayName === $row['day']) ? "selected" : "";
                  echo "<option value='$dayName' $isSelected>$dayName</option>";
                }
                echo '</select>  </div>
                <div class="relative mt-6">';

                // Fetch the course type for the selected course
                $courseTypeQuery = "SELECT course_type FROM course WHERE course_id = ?";
                $courseTypeStmt = $conn->prepare($courseTypeQuery);
                $courseTypeStmt->bind_param("i", $row['course_id']);
                $courseTypeStmt->execute();
                $courseTypeResult = $courseTypeStmt->get_result();
                $courseTypeRow = $courseTypeResult->fetch_assoc();
                $courseType = $courseTypeRow['course_type'];
                ?>
                <!-- // Display time slot dropdown based on course type -->
                <label for='new_time'>Select Time Slot:</label>
                <select name='new_time'
                  class='w-full text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-gray-300'>
                  <?php
                  echo "<option value=''>Select Time Slot</option>";
                  $timetableTimeQuery = "SELECT DISTINCT start_time, end_time FROM timeslot WHERE class_type = ?";
                  $timetableTimeStmt = $conn->prepare($timetableTimeQuery);
                  $timetableTimeStmt->bind_param("s", $courseType);
                  $timetableTimeStmt->execute();
                  $timetableTimeResult = $timetableTimeStmt->get_result();
                  while ($timetableTimeRow = $timetableTimeResult->fetch_assoc()) {
                    $timeSlot = $timetableTimeRow['start_time'] . '|' . $timetableTimeRow['end_time'];
                    $isSelected = ($timeSlot === $row['start_time'] . '|' . $row['end_time']) ? "selected" : "";
                    echo "<option value='$timeSlot' $isSelected>{$timetableTimeRow['start_time']} - {$timetableTimeRow['end_time']}</option>";
                  }
                  ?>
                </select>
            </div>
            <div class="relative mt-6">


              <!-- // Display room dropdown based on course type -->

              <label for='new_room'>Select Room:</label>
              <select name='new_room'
                class="w-full text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-gray-300">
                <option value=''>Select Room</option>
                <?php
                $roomQuery = "SELECT room_id, room_number FROM room WHERE room_type = ?";
                $roomStmt = $conn->prepare($roomQuery);
                $roomStmt->bind_param("s", $courseType);
                $roomStmt->execute();
                $roomResult = $roomStmt->get_result();
                while ($roomRow = $roomResult->fetch_assoc()) {
                  $isSelected = ($roomRow['room_id'] === $row['room_id']) ? "selected" : "";
                  echo "<option value='{$roomRow['room_id']}' $isSelected>{$roomRow['room_number']}</option>";
                }
                ?>
                echo '
              </select>
            </div>
            <div class="relative mt-6">


              <!-- // Display teacher dropdown based on the selected course -->
              <label for='new_teacher'>Select Teacher:</label>
              <select name='new_teacher'
                class="w-full text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-gray-300">
                <option value=''>Select Teacher</option>
                <?php
                $teacherCourseQuery = "SELECT teachers.teacher_id, teachers.name FROM teachers
                         INNER JOIN teachercourses ON teachers.teacher_id = teachercourses.teacher_id
                         WHERE teachercourses.course_id = ?";
                $teacherCourseStmt = $conn->prepare($teacherCourseQuery);
                $teacherCourseStmt->bind_param("i", $row['course_id']);
                $teacherCourseStmt->execute();
                $teacherCourseResult = $teacherCourseStmt->get_result();
                while ($teacherRow = $teacherCourseResult->fetch_assoc()) {
                  $isSelected = ($teacherRow['teacher_id'] === $row['teacher_id']) ? "selected" : "";
                  echo "<option value='{$teacherRow['teacher_id']}' $isSelected>{$teacherRow['name']}</option>";
                } ?>

              </select>
            </div>
            <div class=" my-6">



              <input type='submit' value='Update Routine'
                class="w-full rounded-md bg-gray-900 px-3 py-2 text-white focus:bg-gray-400 focus:outline-none">
            </div>

          </form>

          <!-- <p class="text-center text-sm text-gray-500">
            View The Routine<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
            <a class="underline" href="routine.php">Here</a>
          </p> -->
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$conn->close();
ob_end_flush();
?>
</div>
<script src="../../../include/index.js"></script>


</body>

</html>