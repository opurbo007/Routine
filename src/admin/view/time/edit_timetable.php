<?php

session_start();
ob_start();

include("../../../../database/config.php");
include("../../../include/adminNavbar.php");



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $timetable_id = $_POST["timetable_id"];
  $start_hour = $_POST["start_hour"];
  $start_minute = $_POST["start_minute"];
  $end_hour = $_POST["end_hour"];
  $end_minute = $_POST["end_minute"];
  $class_type = $_POST["class_type"];

  $start_time = sprintf("%02d:%02d:00", $start_hour, $start_minute);
  $end_time = sprintf("%02d:%02d:00", $end_hour, $end_minute);

  $sql_update_timetable = "UPDATE timeslot SET start_time='$start_time', end_time='$end_time', class_type='$class_type' WHERE timetable_id=$timetable_id";


  if ($conn->query($sql_update_timetable) === TRUE) {
    $_SESSION['success_message'] = "Successfully TImeslot Updated";
  } else {

    $_SESSION['error_message'] = "Error! TimeSlot Not updated";
  }
  header('Location: timetable.php');
  exit;
}

if (isset($_GET['timetable_id'])) {
  $timetable_id = $_GET['timetable_id'];

  $sql_select_timetable = "SELECT * FROM timeslot WHERE timetable_id=$timetable_id";
  $result_timetable = $conn->query($sql_select_timetable);

  if ($result_timetable->num_rows > 0) {
    $row = $result_timetable->fetch_assoc();
    $start_time_parts = explode(":", $row['start_time']);
    $end_time_parts = explode(":", $row['end_time']);
    $start_hour = intval($start_time_parts[0]);
    $start_minute = intval($start_time_parts[1]);
    $end_hour = intval($end_time_parts[0]);
    $end_minute = intval($end_time_parts[1]);
    $class_type = $row['class_type'];
    ?>
    <div class="flex flex-col min-h-screen w-full">
      <div class="flex items-center justify-center flex-grow-2">

        <div
          class="relative mx-auto w-full max-w-md bg-white px-6 pt-10 mt-24 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:rounded-xl sm:px-10">
          <div class="w-full">
            <div class="text-center">
              <h1 class="text-2xl font-semibold text-gray-900">Update TimeSlot</h1>
            </div>
            <div class="mt-5">
              <form method="post">
                <input type="hidden" name="timetable_id" value="<?php echo $timetable_id; ?>">

                <div class="relative mt-6">
                  <div class="flex items-center mb-4">

                    <label for="start_hour" class="mr-2">Start Time:</label>
                    <input type="number" id="start_hour" name="start_hour" min="0" max="23"
                      value="<?php echo $start_hour; ?>" required
                      class="w-1/3 px-2 py-1 text-gray-700 border rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-300 focus:outline-none">
                    <span class="mx-1">:</span>

                    <input type="number" id="start_minute" name="start_minute" min="0" max="59"
                      value="<?php echo $start_minute; ?>" required
                      class="w-1/3 px-2 py-1 text-gray-700 border rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-300 focus:outline-none">
                  </div>
                  <div class="flex items-center">
                    <label for="end_hour" class="mr-3.5">End Time</label>
                    <input type="number" id="end_hour" name="end_hour" min="0" max="23" value="<?php echo $end_hour; ?>"
                      required
                      class="w-1/3 px-2 py-1 text-gray-700 border rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-300 focus:outline-none">
                    <span class="mx-1">:</span>
                    <input type="number" id="end_minute" name="end_minute" min="0" max="59"
                      value="<?php echo $end_minute; ?>" required
                      class="w-1/3 px-2 py-1 text-gray-700 border rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-300 focus:outline-none">
                  </div>
                  <div class="relative mt-6">
                    <!-- <label for="class_type">Class Type:</label> -->
                    <select id="class_type" name="class_type" required
                      class="w-full text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-gray-300">
                      <option value="theory" <?php if ($class_type == 'theory')
                        echo 'selected'; ?>>Theory</option>
                      <option value="lab" <?php if ($class_type == 'lab')
                        echo 'selected'; ?>>Lab</option>
                    </select>
                  </div>
                  <div class=" my-6">
                    <input type="submit" value="Update Timetable Entry"
                      class="w-full rounded-md bg-gray-900 px-3 py-2 text-white focus:bg-gray-400 focus:outline-none">
                  </div>
              </form>
              <p class="text-center text-sm text-gray-500">
                View All Room <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                <a class="underline" href="timetable.php">Here</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
  } else {
    $_SESSION['error_message'] = "Error! TimeSlot Not Found";
    header('Location: timetable.php');
  }


} else {
  $_SESSION['error_message'] = "Timetable ID not specified";
  header('Location: timetable.php');
}


$conn->close();
ob_end_flush();

?>
</div>
<script src="../../../include/index.js"></script>
</body>

</html>