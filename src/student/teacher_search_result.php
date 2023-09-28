<?php
session_start();
include("../../database/config.php");
include("../include/studentNavbar.php");

if (isset($_POST['search'])) {
  $selectedDay = $_POST['day'];
  $selectedTime = $_POST['time'];
  $selectedTeacher = $_POST['teacher'];

  // Fetch Teacher ID on teacher name
  $query = "SELECT teacher_id FROM teachers WHERE name = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $selectedTeacher);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $teacherId = $row['teacher_id'];

    $query = "SELECT ro.room_number, c.course_name, b.batch_number
          FROM routine r
          JOIN course c ON r.course_id = c.course_id
          JOIN batch b ON r.batch = b.batch_id
          JOIN room  ro ON r.room_id = ro.room_id
          WHERE r.day = ? 
          AND r.start_time <= ? 
          AND r.end_time >= ? 
          AND r.teacher_id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $selectedDay, $selectedTime, $selectedTime, $teacherId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) { ?>

      <div class="flex flex-col min-h-screen w-full">
        <div class="flex items-center justify-center flex-grow-2">
          <div
            class="relative mx-auto w-full max-w-md bg-white px-6 pt-10 mt-24 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:rounded-xl sm:px-10">
            <div class="w-full">
              <div class="text-center">
                <h1 class="text-2xl font-semibold text-gray-900">Teacher Currently in</h1>
              </div>
              <div class="mt-5">
                <div>
                  <div class="relative mt-6">
                    <ul>
                      <?php
                      while ($row = $result->fetch_assoc()) {
                        ?>
                        <li>Room:
                          <?php echo $row['room_number'] ?>
                        </li>
                        <li>Course:
                          <?php echo $row['course_name'] ?>
                        </li>
                        <li>Batch:
                          <?php echo $row['batch_number'] ?>
                        </li>
                        <?php
                      }
                      ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <?php } else { ?>
      <div class="flex flex-col min-h-screen w-full">
        <div class="flex items-center justify-center flex-grow-2">
          <div
            class="relative mx-auto w-full max-w-md bg-white px-6 pt-10 mt-24 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:rounded-xl sm:px-10">
            <div class="w-full">
              <div class="text-center">
                <h1 class="text-2xl font-semibold text-gray-900">Teacher Not Taking class in the selected time</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php }
  } else {
    echo "Teacher not found.";
  }

  $stmt->close();
}
?>
<script src="../include/index2.js"></script>
</body>

</html>