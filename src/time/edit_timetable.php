<!DOCTYPE html>
<html>

<head>
  <title>Edit Timetable Entry</title>
</head>

<body>
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "routine";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

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
      echo "<p>Timetable entry updated successfully!</p>";
    } else {
      echo "<p>Error updating timetable entry: " . $conn->error . "</p>";
    }
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
      <h2>Edit Timetable Entry</h2>
      <form method="post">
        <input type="hidden" name="timetable_id" value="<?php echo $timetable_id; ?>">
        <label for="start_hour">Start Time:</label>
        <input type="number" id="start_hour" name="start_hour" min="0" max="23" value="<?php echo $start_hour; ?>" required>
        :
        <input type="number" id="start_minute" name="start_minute" min="0" max="59" value="<?php echo $start_minute; ?>"
          required><br>
        <label for="end_hour">End Time:</label>
        <input type="number" id="end_hour" name="end_hour" min="0" max="23" value="<?php echo $end_hour; ?>" required> :
        <input type="number" id="end_minute" name="end_minute" min="0" max="59" value="<?php echo $end_minute; ?>"
          required><br>
        <label for="class_type">Class Type:</label>
        <select id="class_type" name="class_type" required>
          <option value="theory" <?php if ($class_type == 'theory')
            echo 'selected'; ?>>Theory</option>
          <option value="lab" <?php if ($class_type == 'lab')
            echo 'selected'; ?>>Lab</option>
        </select><br>
        <input type="submit" value="Update Timetable Entry">
      </form>
      <?php
    } else {
      echo "<p>Timetable entry not found.</p>";
    }
  } else {
    echo "<p>Timetable ID not specified.</p>";
  }

  $conn->close();
  ?>
</body>

</html>