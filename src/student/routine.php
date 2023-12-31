<?php
session_start();
include("../../database/config.php");
include("../include/studentNavbar.php");

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
<!-- <style>
.nav-container {
  flex: 0 0 99px;
}
</style> -->
<div class="flex flex-col min-h-screen w-full">
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
  <?php


  // Fetch the generated routine based on batch, semester, and session
  
  $routineQuery = "SELECT routine_id, course.course_code, course.course_name, day, start_time, end_time, room_number, name FROM routine
  INNER JOIN course ON routine.course_id = course.course_id
  INNER JOIN room ON routine.room_id = room.room_id
  INNER JOIN teachers ON routine.teacher_id = teachers.teacher_id
  WHERE batch = ? AND semester = ? AND session = ?";
  // Adding session condition
  
  $routineStmt = $conn->prepare($routineQuery);
  $routineStmt->bind_param("iis", $selectedBatch, $selectedSemester, $selectedSession); 
  $routineStmt->execute();
  $routineResult = $routineStmt->get_result();
  ?>

  <div class="container mx-auto py-8 w-[112rem]">

    <table class="table-auto w-full bg-white">
      <thead>
        <tr>
          <th class="px-4 border py-2">Day & Time</th>
          <?php
  $timeSlotsToShow = array(); // Store time slots with at least one class

  $timeSlotQuery = "SELECT DISTINCT start_time, end_time FROM timeslot";
  $timeSlotResult = $conn->query($timeSlotQuery);
  $timeSlots = array();

  while ($row = $timeSlotResult->fetch_assoc()) {
    $timeSlots[] = $row;
  }

      foreach ($timeSlots as $timeSlot) {
        $found = false;

        mysqli_data_seek($routineResult, 0);

        while ($row = $routineResult->fetch_assoc()) {
          // Check if the routine matches the current time slot
          if ($row['start_time'] == $timeSlot['start_time'] && $row['end_time'] == $timeSlot['end_time']) {
            $found = true;
            break;
          }
        }

           // Only display and store the time slot if at least one class is found
           if ($found) {

            $startTime = date("h:i A", strtotime($timeSlot['start_time']));
            $endTime = date("h:i A", strtotime($timeSlot['end_time']));
            echo "<th colspan='3' class='border pl-2 py-2'>$startTime - $endTime</th>";
            $timeSlotsToShow[] = $timeSlot;
          }
        }
    ?>
        </tr>
      </thead>


      <tbody>


        <?php
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        foreach ($days as $day) {
          echo "<tr>";
          echo "<td class='border px-4 py-4'>$day</td>";

          foreach ($timeSlotsToShow as $timeSlot) { ?>

        <td colspan='3' class='border px-4 py-4'>

          <?php
              $routineResult->data_seek(0);
              $found = false;
              while ($row = $routineResult->fetch_assoc()) {
                if ($row['day'] == $day && $row['start_time'] == $timeSlot['start_time'] && $row['end_time'] == $timeSlot['end_time']) {
                  echo "<div class='text-center'><span class='font-bold'>{$row['course_code']}</span><br>{$row['course_name']}<br><b>{$row['name']}</b><br>({$row['room_number']})</div><br>";

                  $found = true;

                }
              }

              if (!$found) {
                echo "<div class='text-center'>✘</div>";
              }

              echo "</td>";
          }

          echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";

        ?>

  </div>
  <div class="flex justify-center my-4">
    <button class="bg-gradient-to-r from-green-600 to-blue-600 text-white font-bold py-2 px-4 rounded-full">
      <a
        href="pdf.php?batch=<?php echo $selectedBatch; ?>&semester=<?php echo $selectedSemester; ?>&session=<?php echo $selectedSession; ?>">Download</a>
    </button>
  </div>

  <?php
  $conn->close();
  ?>
</div>
<script src="../include/index2.js"></script>


</body>

</html>