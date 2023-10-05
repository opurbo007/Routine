<?php
include("../include/auth2.php");
include("../../database/config.php");
include("../include/teacherNavbar.php");

// Fetch time slots from the database
$timeSlotsQuery = "SELECT DISTINCT TIME_FORMAT(start_time, '%h:%i %p') AS start_time, TIME_FORMAT(end_time, '%h:%i %p') AS end_time FROM timeslot ORDER BY start_time";
$timeSlotsResult = $conn->query($timeSlotsQuery);
$timeSlots = [];
while ($row = $timeSlotsResult->fetch_assoc()) {
  $timeSlots[] = "{$row['start_time']} - {$row['end_time']}";
}

// Fetch and display the teacher's routine
if (isset($_SESSION["teacher_id"])) {
  $teacherId = $_SESSION["teacher_id"];
  $routineQuery = "SELECT routine.day, TIME_FORMAT(routine.start_time, '%h:%i %p') AS start_time, TIME_FORMAT(routine.end_time, '%h:%i %p') AS end_time, course.course_code, course.course_name, room.room_number, batch.batch_number, semester.semester_name, course.course_id
                 FROM routine
                 INNER JOIN course ON routine.course_id = course.course_id
                 INNER JOIN room ON routine.room_id = room.room_id
                 INNER JOIN batch ON routine.batch = batch.batch_id
                 INNER JOIN semester ON routine.semester = semester.semester_id
                 WHERE routine.teacher_id = ?
                 ORDER BY FIELD(routine.day,'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'), routine.start_time";


  $routineStmt = $conn->prepare($routineQuery);
  $routineStmt->bind_param("i", $teacherId);
  $routineStmt->execute();
  $routineResult = $routineStmt->get_result();
  ?>

<div class="container mx-auto py-8">
  <h1 class="text-3xl font-bold mb-10 text-center">Class Routine</h1>
  <table class="table-auto w-full bg-white">
    <thead>
      <tr>
        <th class="px-4 border py-2">Day & Time</th>
        <?php
          $columnsToDisplay = [];

          foreach ($timeSlots as $timeSlot) {
            $found = false;

            $routineResult->data_seek(0);
            while ($row = $routineResult->fetch_assoc()) {
              if ("{$row['start_time']} - {$row['end_time']}" == $timeSlot) {
                $found = true;
                break;
              }
            }

            if ($found) {
              echo "<th class='px-4 border py-2'>{$timeSlot}</th>";
              $columnsToDisplay[] = $timeSlot;
            }
          }
          ?>
      </tr>
    </thead>
    <tbody>
      <?php
        $days = ['Saturday','Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        foreach ($days as $day) {
          echo "<tr>";
          echo "<td class='border px-4 py-2'>{$day}</td>";
          foreach ($columnsToDisplay as $timeSlot) {
            $classes = [];
            $hasLab = false; // Flag to track if there's a lab class in this time slot
        
            $routineResult->data_seek(0);
            while ($row = $routineResult->fetch_assoc()) {
                if ($row['day'] == $day && "{$row['start_time']} - {$row['end_time']}" == $timeSlot) {
                    // Fetch the course_type from the course table based on the course_id
                    $courseId = $row['course_id'];
                    $courseTypeQuery = "SELECT course_type FROM course WHERE course_id = ?";
                    $courseTypeStmt = $conn->prepare($courseTypeQuery);
                    $courseTypeStmt->bind_param("i", $courseId);
                    $courseTypeStmt->execute();
                    $courseTypeResult = $courseTypeStmt->get_result();
        
                    if ($courseTypeRow = $courseTypeResult->fetch_assoc()) {
                        if ($courseTypeRow['course_type'] == 'lab') {
                            $hasLab = true; // Set the flag if a lab class is found
                        }
                    }
        
                    $classes[] = "<div class='text-center'><span class='font-bold'>{$row['course_code']}</span><br>{$row['course_name']}<br><span class='font-bold'>{$row['room_number']}</span><br><span>[{$row['batch_number']} ({$row['semester_name']})]</span></div>";
                }
            }
        
            // Determine the background color based on the flag
            $cellBackgroundColor = $hasLab ? "background-color: #00d2ff;" : "";
        
            echo "<td class='border px-4 py-2' style='{$cellBackgroundColor}'>";
            if (empty($classes)) {
                echo "<div class='text-center'>✘</div>";
            } else {
                foreach ($classes as $class) {
                    echo "{$class}<br>";
                }
            }
            echo "</td>";
        }
        
          echo "</tr>";
        }
        ?>
    </tbody>
  </table>
  <div class="flex justify-center mt-8">
    <button class="bg-gradient-to-r from-green-600 to-blue-600 text-white font-bold py-2 px-4 rounded-full">
      <a href="pdf.php?teacher_id=<?php echo $teacherId; ?>">Download</a>
    </button>
  </div>

  <?php
} else {
  echo "You are not authorized to view this page.";
}

$conn->close();
?>

</div>
<script src="../include/index2.js"></script>
</body>

</html>