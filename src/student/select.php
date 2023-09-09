<?php
session_start();
include("../../database/config.php");
include("../include/studentNavbar.php"); ?>

<div class="flex flex-col min-h-screen w-full">

  <div
    class="relative mx-auto w-full max-w-md bg-white px-6 pt-10 mt-24 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:rounded-xl sm:px-10">
    <div class="w-full">
      <div class="mt-5">

        <form action="routine.php" method="post">
          <div class="relative mt-6">
            <label for="batch">Select Batch:</label>
            <select name="batch" id="batch"
              class="w-full text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-gray-300">
              <?php

              $batchQuery = "SELECT batch_id, batch_number FROM batch";
              $batchResult = $conn->query($batchQuery);

              while ($batchRow = $batchResult->fetch_assoc()) {
                echo "<option value='{$batchRow['batch_id']}'>{$batchRow['batch_number']}</option>";
              }
              ?>
            </select>
          </div>
          <div class="relative mt-6 ">

            <label for="semester">Select Semester:</label>
            <select name="semester" id="semester"
              class="w-full text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-gray-300">
              <!-- Fetch and populate semester options from the database -->
              <?php
              $semesterQuery = "SELECT semester_id, semester_name FROM semester";
              $semesterResult = $conn->query($semesterQuery);

              while ($semesterRow = $semesterResult->fetch_assoc()) {
                echo "<option value='{$semesterRow['semester_id']}'>{$semesterRow['semester_name']}</option>";
              }
              ?>
            </select>
          </div>
          <div class="relative mt-6 ">
            <label for="session">Select Session:</label>
            <select name="session" id="session"
              class="w-full text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-gray-300">
              <option value="Fall">Fall</option>
              <option value="Spring">Spring</option>



            </select>
          </div>
          <div class=" my-6">
            <input type="submit" value="Submit"
              class="w-full rounded-md bg-gray-900 px-3 py-2 text-white focus:bg-gray-400 focus:outline-none">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
$conn->close();
?>
</div>
<script src="../include/index2.js"></script>


</body>

</html>