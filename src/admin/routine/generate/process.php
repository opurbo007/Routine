<?php
include("../../../include/auth.php");
include("../../../../database/config.php");
include("../../../include/adminNavbar.php");
?>

<div class="flex flex-col min-h-screen w-full">

  <?php

  // Take batch, semester, and session info from previous page
  $selectedBatch = $_POST['batch'];
  $selectedSemester = $_POST['semester'];
  $selectedSession = $_POST['session'];

  // Fetch batch name
  $batchQuery = "SELECT batch_number FROM batch WHERE batch_id = ?";
  $batchStmt = $conn->prepare($batchQuery);
  $batchStmt->bind_param("i", $selectedBatch);
  $batchStmt->execute();
  $batchResult = $batchStmt->get_result();
  $batchRow = $batchResult->fetch_assoc();
  $selectedBatchName = $batchRow['batch_number'];

  // Fetch semester name
  $semesterQuery = "SELECT semester_name FROM semester WHERE semester_id = ?";
  $semesterStmt = $conn->prepare($semesterQuery);
  $semesterStmt->bind_param("i", $selectedSemester);
  $semesterStmt->execute();
  $semesterResult = $semesterStmt->get_result();
  $semesterRow = $semesterResult->fetch_assoc();
  $selectedSemesterName = $semesterRow['semester_name'];

  ?>

  <!-- // Display batch, semester, and session info -->
  <div class="flex justify-between mt-4">
    <div>
      <p class="border border-black flex">
        <a href="select.php"
          class="inline-block px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-600 hover:no-underline">
          Back
        </a>
      </p>
    </div>
  </div>
  <div class="flex flex-col justify-center">
    <div class="w-full text-center">
      <h3 class="text-2xl font-semibold mb-1">Batch:
        <?php echo $selectedBatchName; ?>
      </h3>
      <h3 class="text-2xl font-semibold mb-1">Semester:
        <?php echo $selectedSemesterName; ?>
      </h3>
      <h3 class="text-2xl font-semibold mb-1">Session:
        <?php echo $selectedSession; ?>
      </h3>
    </div>
  </div>



  <!-- // Display the form to generate the routine -->
  <div class="w-full">

    <form action="generate_routine.php" method="post" class=" mb-4 justify-center ">
      <input type="hidden" name="batch" value="<?php echo $selectedBatch; ?>">
      <input type="hidden" name="semester" value="<?php echo $selectedSemester; ?>">
      <input type="hidden" name="session" value="<?php echo $selectedSession; ?>">
      <div class="flex flex-wrap justify-between my-4 ">
        <!-- Fetch and display courses for the selected semester -->
        <?php
        $courseQuery = "SELECT course_id, course_name, course_type FROM course WHERE semester_id = ?";
        $courseStmt = $conn->prepare($courseQuery);
        $courseStmt->bind_param("i", $selectedSemester);
        $courseStmt->execute();
        $courseResult = $courseStmt->get_result();

        while ($courseRow = $courseResult->fetch_assoc()) {
          ?>
          <div class="flex flex-row w-1/2 ">
            <div class=" mr-3 bg-white rounded-lg shadow-md p-6 mb-4 w-full">
              <h2 class="text-2xl text-center font-semibold mb-4">
                <?php echo $courseRow['course_name']; ?>
              </h2>

              <div class="day-time-fields flex flex-wrap -mx-2">
                <?php foreach (['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $dayName) { ?>
                  <div class="day-time-field w-1/3 px-2 mb-2">
                    <label for="<?php echo "{$courseRow['course_id']}_{$dayName}"; ?>"
                      class="block text-sm font-medium text-gray-700"><?php echo $dayName; ?>:
                      <input type="checkbox" name="day[<?php echo $courseRow['course_id']; ?>][]"
                        value="<?php echo $dayName; ?>" id="<?php echo "{$courseRow['course_id']}_{$dayName}"; ?>"
                        class="mt-2"></label>

                    <?php
                    $courseType = $courseRow['course_type'];

                    // Fetch appropriate time slots based on course type
                    $timetableTimeQuery = "SELECT DISTINCT start_time, end_time FROM timeslot WHERE class_type = ?";

                    $timetableTimeStmt = $conn->prepare($timetableTimeQuery);
                    $timetableTimeStmt->bind_param("s", $courseType);
                    $timetableTimeStmt->execute();
                    $timetableTimeResult = $timetableTimeStmt->get_result();
                    ?>

                    <select name="time[<?php echo $courseRow['course_id']; ?>][<?php echo $dayName; ?>]"
                      class="mt-2 block w-full bg-white border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 focus:border-blue-500">
                      <?php while ($timetableTimeRow = $timetableTimeResult->fetch_assoc()) { ?>
                        <option value="<?php echo "{$timetableTimeRow['start_time']}|{$timetableTimeRow['end_time']}"; ?>">
                          <?php echo "{$timetableTimeRow['start_time']} - {$timetableTimeRow['end_time']}"; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                <?php } ?>
              </div>

              <?php
              // Fetch and display room options based on course type
              $roomQuery = "SELECT room_id, room_number, room_type FROM room WHERE room_type = ?";
              $roomType = ($courseType === 'theory') ? 'theory' : 'Lab';
              $roomStmt = $conn->prepare($roomQuery);
              $roomStmt->bind_param("s", $roomType);
              $roomStmt->execute();
              $roomResult = $roomStmt->get_result();
              ?>

              <div class="mb-4">
                <label for="room" class="block text-sm font-medium text-gray-700">Select Room:</label>
                <select name="room[<?php echo $courseRow['course_id']; ?>]"
                  class="mt-2 block w-full bg-white border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 focus:border-blue-500">
                  <?php while ($roomRow = $roomResult->fetch_assoc()) { ?>
                    <option value="<?php echo $roomRow['room_id']; ?>">
                      <?php echo $roomRow['room_number']; ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <?php
              // Fetch and display teacher options based on the course
              $teacherCourseQuery = "SELECT teachers.teacher_id, teachers.name FROM teachers
                               INNER JOIN teachercourses ON teachers.teacher_id = teachercourses.teacher_id
                               WHERE teachercourses.course_id = ?";

              $teacherCourseStmt = $conn->prepare($teacherCourseQuery);
              $teacherCourseStmt->bind_param("i", $courseRow['course_id']);
              $teacherCourseStmt->execute();
              $teacherCourseResult = $teacherCourseStmt->get_result();
              ?>

              <div class="mb-4">
                <label for="teacher" class="block text-sm font-medium text-gray-700">Select Teacher:</label>
                <select name="teacher[<?php echo $courseRow['course_id']; ?>]"
                  class="mt-2 block w-full bg-white border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 focus:border-blue-500">
                  <?php while ($teacherRow = $teacherCourseResult->fetch_assoc()) { ?>
                    <option value="<?php echo $teacherRow['teacher_id']; ?>">
                      <?php echo $teacherRow['name']; ?>
                    </option>
                  <?php } ?>
                </select>

              </div>
            </div>
          </div>
        <?php } ?>
      </div>

      <div class="w-full mt-4">
        <input type="submit" value="Generate Routine"
          class="w-full bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-700 cursor-pointer mb-6">
      </div>
    </form>
  </div>



</div>

<?php
$conn->close();
?>
</div>
<script src="../../../include/index.js"></script>


</body>

</html>