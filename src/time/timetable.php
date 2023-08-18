<!DOCTYPE html>
<html>

<head>
  <title>Timetable</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
  <h2>Timetable</h2>
  <a href="../../add/add_timetable.php">Add Timetable Entry</a>

  <form action="" method="get">
    <label for="search_class_type">Search by Class Type:</label>
    <select id="search_class_type" name="search_class_type">
      <option value="">All Class Types</option>
      <option value="theory">Theory</option>
      <option value="lab">Lab</option>
    </select>
    <input type="submit" value="Search">
  </form>

  <table>
    <thead>
      <tr>
        <th>Start Time</th>
        <th>End Time</th>
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

      $search_class_type = $_GET['search_class_type'] ?? '';

      $sql_timetable = "SELECT * FROM timeslot";

      if (!empty($search_class_type)) {
        $sql_timetable .= " WHERE class_type = '$search_class_type'";
      }

      $result_timetable = $conn->query($sql_timetable);

      if ($result_timetable->num_rows > 0) {
        while ($row = $result_timetable->fetch_assoc()) {
          $timetable_id = $row['timetable_id'];
          $start_time = $row['start_time'];
          $end_time = $row['end_time'];
          $class_type = $row['class_type'];

          echo "<tr>";
          echo "<td>$start_time</td>";
          echo "<td>$end_time</td>";
          echo "<td>$class_type</td>";
          echo "<td>
                            <a href='edit_timetable.php?timetable_id=$timetable_id'>Edit</a>
                            <a href='delete_timetable.php?timetable_id=$timetable_id'>Delete</a>
                          </td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='4'>No timetable entries found.</td></tr>";
      }

      $conn->close();
      ?>
    </tbody>
  </table>
</body>

</html>