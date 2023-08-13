<!DOCTYPE html>
<html>

<head>
  <title>Timetable</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
  <h2>Timetable</h2>
  <a href="../add/add_timetable.php">Add Timetable Entry</a>

  <form action="" method="get">
    <label for="search_day">Search by Day:</label>
    <select id="search_day" name="search_day">
      <option value="">All Days</option>
      <option value="Monday">Monday</option>
      <option value="Tuesday">Tuesday</option>
      <option value="Wednesday">Wednesday</option>
      <option value="Thursday">Thursday</option>
      <option value="Friday">Friday</option>
      <option value="Saturday">Saturday</option>
      <option value="Sunday">Sunday</option>
    </select>
    <input type="submit" value="Search">
  </form>

  <table>
    <thead>
      <tr>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Day</th>
        <th>Class Type</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "routine";

      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $search_day = $_GET['search_day'] ?? '';

      $sql_timetable = "SELECT * FROM Timetable";

      if (!empty($search_day)) {
        $sql_timetable .= " WHERE day = '$search_day'";
      }

      $result_timetable = $conn->query($sql_timetable);

      if ($result_timetable->num_rows > 0) {
        while ($row = $result_timetable->fetch_assoc()) {
          $timetable_id = $row['timetable_id'];
          $start_time = $row['start_time'];
          $end_time = $row['end_time'];
          $day = $row['day'];
          $class_type = $row['class_type'];

          echo "<tr>";
          echo "<td>$start_time</td>";
          echo "<td>$end_time</td>";
          echo "<td>$day</td>";
          echo "<td>$class_type</td>";
          echo "<td>
                            <a href='edit_timetable.php?timetable_id=$timetable_id'>Edit</a>
                            <a href='delete_timetable.php?timetable_id=$timetable_id'>Delete</a>
                          </td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='5'>No timetable entries found.</td></tr>";
      }

      $conn->close();
      ?>
    </tbody>
  </table>
</body>

</html>