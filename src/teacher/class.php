<?php
include("../include/auth2.php");
include("../../database/config.php");
include("../include/teacherNavbar.php");

// Get the current day and time
date_default_timezone_set('Asia/Dhaka');
$currentDay = date("l"); 
$currentTime = date("H:i"); 


// Fetch and display the teacher's current classes
if (isset($_SESSION["teacher_id"])) {
  $teacherId = $_SESSION["teacher_id"];
  
  $routineQuery = "SELECT day, TIME_FORMAT(start_time, '%H:%i') AS start_time, TIME_FORMAT(end_time, '%H:%i') AS end_time, course_code, course_name, room_number, batch_number
                     FROM routine
                     INNER JOIN course ON routine.course_id = course.course_id
                     INNER JOIN room ON routine.room_id = room.room_id
                     INNER JOIN batch ON routine.batch = batch.batch_id
                     WHERE teacher_id = ? AND day = ? AND start_time <= ? AND end_time >= ?
                     ORDER BY start_time";
  $routineStmt = $conn->prepare($routineQuery);
  $routineStmt->bind_param("isss", $teacherId, $currentDay, $currentTime, $currentTime);
  $routineStmt->execute();
  $routineResult = $routineStmt->get_result();
  ?>

<div class="container mx-auto py-8">
  <h1 class="text-3xl font-bold mb-10 text-center">Onging Class<br> <?php echo $currentDay; ?></h1>

  <table class="table-auto w-full">
  <thead class='border px-4 py-2'>
      <tr>
        <th class="border px-4 py-2">Time</th>
        <th class="border px-4 py-2">Course Code</th>
        <th class="border px-4 py-2">Course Name</th>
        <th class="border px-4 py-2">Batch Number</th>
        <th class="border px-4 py-2">Room Number</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $classFound = false;
      while ($row = $routineResult->fetch_assoc()) {
        $classFound = true;
        $start_time_12hr = date("h:i A", strtotime($row['start_time']));
        $end_time_12hr = date("h:i A", strtotime($row['end_time']));
    
        echo "<tr>";
        echo "<td class='border px-4 py-2'>$start_time_12hr - $end_time_12hr</td>";
        echo "<td class='border px-4 py-2'>{$row['course_code']}</td>";
        echo "<td class='border px-4 py-2'>{$row['course_name']}</td>";
        echo "<td class='border px-4 py-2'>{$row['batch_number']}</td>";
        echo "<td class='border px-4 py-2'>{$row['room_number']}</td>";
        echo "</tr>";
    }
    
      if (!$classFound) {
        echo "<tr>";
        echo "<td colspan='5' class='border px-4 py-2 text-center'>Off time</td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div>

<?php
} else {
  echo "You are not authorized to view this page.";
}

$conn->close();
?>
