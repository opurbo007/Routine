<?php
session_start();
include("../../database/config.php");
include("../include/teacherNavbar.php");

// Fetch time slots from the database
$timeSlotsQuery = "SELECT DISTINCT TIME_FORMAT(start_time, '%h:%i') AS start_time, TIME_FORMAT(end_time, '%h:%i') AS end_time FROM timeslot ORDER BY start_time";
$timeSlotsResult = $conn->query($timeSlotsQuery);
$timeSlots = [];
while ($row = $timeSlotsResult->fetch_assoc()) {
  $timeSlots[] = "{$row['start_time']} - {$row['end_time']}";
}

// Fetch and display the teacher's routine
if (isset($_SESSION["teacher_id"])) {
  $teacherId = $_SESSION["teacher_id"];
  $routineQuery = "SELECT day, TIME_FORMAT(start_time, '%h:%i') AS start_time, TIME_FORMAT(end_time, '%h:%i') AS end_time, course_code, course_name, room_number
                     FROM routine
                     INNER JOIN course ON routine.course_id = course.course_id
                     INNER JOIN room ON routine.room_id = room.room_id
                     WHERE teacher_id = ?
                     ORDER BY FIELD(day, 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'), start_time";
  $routineStmt = $conn->prepare($routineQuery);
  $routineStmt->bind_param("i", $teacherId);
  $routineStmt->execute();
  $routineResult = $routineStmt->get_result();
  ?>

  <div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-10 text-center">Class Routine</h1>
    <table class="table-auto w-full">
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
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        foreach ($days as $day) {
          echo "<tr>";
          echo "<td class='border px-4 py-2'>{$day}</td>";

          foreach ($columnsToDisplay as $timeSlot) {
            $classes = [];

            $routineResult->data_seek(0);
            while ($row = $routineResult->fetch_assoc()) {
              if ($row['day'] == $day && "{$row['start_time']} - {$row['end_time']}" == $timeSlot) {
                $classes[] = "{$row['course_code']}<br>{$row['course_name']}<br>{$row['room_number']}";
              }
            }

            echo "<td class='border px-4 py-2'>";
            if (empty($classes)) {
              echo "Off day";
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

<script src="../include/index.js"></script>
</body>

</html>