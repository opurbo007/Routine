<!DOCTYPE html>
<html>

<head>
  <title>Edit Room</title>
</head>

<body>
  <?php
  // Replace these variables with your database credentials
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "routine";

  // Create a database connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check if the connection was successful
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Handle the form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["room_id"]) && isset($_POST["room_number"]) && isset($_POST["room_type"])) {
    $room_id = $_POST["room_id"];
    $room_number = $_POST["room_number"];
    $room_type = $_POST["room_type"];

    // Update the room details in the Room table
    $sql_update_room = "UPDATE Room SET room_number = '$room_number', room_type = '$room_type' WHERE room_id = $room_id";

    if ($conn->query($sql_update_room) === TRUE) {
      echo "<p>Room updated successfully!</p>";
    } else {
      echo "<p>Error updating room: " . $conn->error . "</p>";
    }
  } elseif (isset($_GET["room_id"])) {
    $room_id = $_GET["room_id"];

    // Fetch room data
    $sql_room = "SELECT * FROM Room WHERE room_id = $room_id";
    $result_room = $conn->query($sql_room);

    if ($result_room->num_rows == 1) {
      $row = $result_room->fetch_assoc();
      $room_number = $row['room_number'];
      $room_type = $row['room_type'];
    } else {
      echo "<p>Error: Room not found.</p>";
      exit;
    }
  } else {
    echo "<p>Error: Room ID not provided.</p>";
    exit;
  }

  // Close the database connection
  $conn->close();
  ?>

  <h2>Edit Room</h2>
  <form method="post">
    <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
    <label for="room_number">Room Number:</label>
    <input type="text" id="room_number" name="room_number" value="<?php echo $room_number; ?>" required>
    <br><br>
    <input type="radio" id="theory" name="room_type" value="theory" <?php if ($room_type === 'theory')
      echo 'checked'; ?>
      required>
    <label for="theory">Theory</label>
    <input type="radio" id="lab" name="room_type" value="lab" <?php if ($room_type === 'lab')
      echo 'checked'; ?> required>
    <label for="lab">Lab</label>
    <br><br>
    <input type="submit" value="Update Room">
  </form>
</body>

</html>