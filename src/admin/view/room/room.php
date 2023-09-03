<!DOCTYPE html>
<html>

<head>
  <title>Room Management</title>
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

  // Handle search
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    $search = $_POST["search"];

    // Search for rooms based on room number or room type
    $sql_search = "SELECT * FROM Room WHERE room_number LIKE '%$search%' OR room_type LIKE '%$search%'";
    $result_search = $conn->query($sql_search);
  } else {
    // Fetch all rooms
    $sql_all_rooms = "SELECT * FROM Room";
    $result_all_rooms = $conn->query($sql_all_rooms);
  }

  // Close the database connection
  $conn->close();
  ?>

  <h2>Room Management</h2>

  <form method="post">
    <input type="text" name="search" placeholder="Search by room number or type">
    <button type="submit">Search</button>
  </form>

  <h3>Room List</h3>
  <table border="1">
    <tr>
      <th>Room Number</th>
      <th>Room Type</th>
      <th>Action</th>
    </tr>
    <?php
    if (isset($result_search)) {
      if ($result_search->num_rows > 0) {
        while ($row = $result_search->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row['room_number'] . "</td>";
          echo "<td>" . $row['room_type'] . "</td>";
          echo "<td><a href='edit_room.php?room_id=" . $row['room_id'] . "'>Edit</a> | <a href='delete_room.php?room_id=" . $row['room_id'] . "'>Delete</a></td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='3'>No rooms found.</td></tr>";
      }
    } else {
      if ($result_all_rooms->num_rows > 0) {
        while ($row = $result_all_rooms->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row['room_number'] . "</td>";
          echo "<td>" . $row['room_type'] . "</td>";
          echo "<td><a href='edit_room.php?room_id=" . $row['room_id'] . "'>Edit</a> | <a href='delete_room.php?room_id=" . $row['room_id'] . "'>Delete</a></td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='3'>No rooms found.</td></tr>";
      }
    }
    ?>
  </table>

  <p><a href="../add/add_room.php">Add New Room</a></p>
</body>

</html>