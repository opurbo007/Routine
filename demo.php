<?php
session_start();
include("database/config.php"); ?>

<body>
  <h1>Class Information</h1>

  <!-- User Input Form -->
  <form method="post" action="">
    <label for="day">Select Day:</label>
    <select name="day" id="day">
      <option value="Monday">Monday</option>
      <option value="Tuesday">Tuesday</option>
      <option value="Wednesday">Wednesday</option>
      <option value="Thursday">Thursday</option>
      <option value="Friday">Friday</option>
      <option value="Saturday">Saturday </option>

    </select><br><br>

    <label for="time">Select Time (24-hour format):</label>
    <input type="time" name="time" id="time" placeholder="HH:MM" required><br><br>


    <label for="teacher">Select Teacher:</label>
    <select name="teacher" id="teacher">
      <?php
      $teacherQuery = "SELECT teacher_id, name FROM teachers";
      $teacherResult = $conn->query($teacherQuery);

      if ($teacherResult->num_rows > 0) {
        while ($row = $teacherResult->fetch_assoc()) {
          echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
        }
      } else {
        echo "<option value=''>No teachers found</option>";
      }
      ?>
    </select><br><br>

    <input type="submit" name="search" value="Search">
  </form>



  <?php

  // Handle Form Submission
  // Handle Form Submission
  if (isset($_POST['search'])) {
    $selectedDay = $_POST['day'];
    $selectedTime = $_POST['time'];
    $selectedTeacher = $_POST['teacher'];

    // Fetch Teacher ID based on the teacher's name
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

      if ($result->num_rows > 0) {
        echo "<h2>Class Information:</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
          echo "<li>Room: " . $row['room_number'] . "</li>";
          echo "<li>Course: " . $row['course_name'] . "</li>";
          echo "<li>Batch: " . $row['batch_number'] . "</li>";
        }
        echo "</ul>";
      } else {
        echo "No classes found for the selected criteria.";
      }
    } else {
      echo "Teacher not found.";
    }

    $stmt->close();
  }



  ?>
</body>

</html>