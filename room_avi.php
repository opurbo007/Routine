<h1>Room Availability</h1>

<!-- User Input Form -->
<form method="post" action="">
  <label for="day">Select Day:</label>
  <select name="day" id="day">
    <option value="Monday">Monday</option>
    <option value="Tuesday">Tuesday</option>
    <option value="Wednesday">Wednesday</option>
    <option value="Thursday">Thursday</option>
    <option value="Friday">Friday</option>
    <option value="Saturday">Saturday</option>
  </select><br><br>

  <label for="time">Select Time (24-hour format):</label>
  <input type="time" name="time" id="time" placeholder="HH:MM" required><br><br>

  <input type="submit" name="search_room" value="Check Room Availability">
</form>
<?php
session_start();
include("database/config.php"); ?>
<?php
if (isset($_POST['search_room'])) {
  $selectedDay = $_POST['day'];
  $selectedTime = $_POST['time'];

  // Query to retrieve available regular rooms
  $regularRoomQuery = "SELECT r.room_number, r.room_type
    FROM room r
    WHERE r.room_id NOT IN (
      SELECT room_id FROM routine
      WHERE day = ?
      AND start_time <= ? 
      AND end_time >= ?
    ) AND r.room_type = 'theory'";

  $stmt = $conn->prepare($regularRoomQuery);
  $stmt->bind_param("sss", $selectedDay, $selectedTime, $selectedTime);
  $stmt->execute();
  $regularRoomResult = $stmt->get_result();

  // Query to retrieve available lab rooms
  $labRoomQuery = "SELECT r.room_number, r.room_type
    FROM room r
    WHERE r.room_id NOT IN (
      SELECT room_id FROM routine
      WHERE day = ?
      AND start_time <= ? 
      AND end_time >= ?
    ) AND r.room_type = 'Lab'";

  $stmt = $conn->prepare($labRoomQuery);
  $stmt->bind_param("sss", $selectedDay, $selectedTime, $selectedTime);
  $stmt->execute();
  $labRoomResult = $stmt->get_result();

  if (($regularRoomResult->num_rows > 0 || $labRoomResult->num_rows > 0)) {
    echo "<h2>Available Rooms:</h2>";

    // Display available regular rooms in a table
    if ($regularRoomResult->num_rows > 0) {
      echo "<h3>Regular Rooms:</h3>";
      echo "<table>";
      echo "<tr><th>Room Number</th><th>Room Type</th></tr>";
      while ($row = $regularRoomResult->fetch_assoc()) {
        echo "<tr><td>" . $row['room_number'] . "</td><td>" . $row['room_type'] . "</td></tr>";
      }
      echo "</table>";
    }

    // Display available lab rooms in a table
    if ($labRoomResult->num_rows > 0) {
      echo "<h3>Lab Rooms:</h3>";
      echo "<table>";
      echo "<tr><th>Room Number</th><th>Room Type</th></tr>";
      while ($row = $labRoomResult->fetch_assoc()) {
        echo "<tr><td>" . $row['room_number'] . "</td><td>" . $row['room_type'] . "</td></tr>";
      }
      echo "</table>";
    }
  } else {
    echo "No rooms available for the selected day and time.";
  }

  $stmt->close();
}


?>