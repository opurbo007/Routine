<!DOCTYPE html>
<html>

<head>
  <title>Class Routine Generator</title>
</head>

<body>
  <h1>Class Routine Generator</h1>

  <form action="routine.php" method="post">
    <label for="batch">Select Batch:</label>
    <select name="batch" id="batch">
      <!-- Fetch and populate batch options from the database -->
      <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "routine";

      $connection = new mysqli($servername, $username, $password, $dbname);

      $batchQuery = "SELECT batch_id, batch_number FROM batch";
      $batchResult = $connection->query($batchQuery);

      while ($batchRow = $batchResult->fetch_assoc()) {
        echo "<option value='{$batchRow['batch_id']}'>{$batchRow['batch_number']}</option>";
      }
      ?>
    </select>

    <br>

    <label for="semester">Select Semester:</label>
    <select name="semester" id="semester">
      <!-- Fetch and populate semester options from the database -->
      <?php
      $semesterQuery = "SELECT semester_id, semester_name FROM semester";
      $semesterResult = $connection->query($semesterQuery);

      while ($semesterRow = $semesterResult->fetch_assoc()) {
        echo "<option value='{$semesterRow['semester_id']}'>{$semesterRow['semester_name']}</option>";
      }
      ?>
    </select>

    <br>

    <label for="session">Select Session:</label>
    <select name="session" id="session">
      <option value="Spring">Spring</option>

      <option value="Fall">Fall</option>

    </select>

    <br>

    <input type="submit" value="Submit">
  </form>
</body>

</html>