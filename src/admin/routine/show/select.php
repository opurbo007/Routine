<?php
include("../../../include/auth.php");
include("../../../../database/config.php");
include("../../../include/adminNavbar.php");
?>

<div class="flex flex-col min-h-screen w-full">

  <?php
  if (isset($_SESSION['success_message'])) {

    $successMessage = $_SESSION['success_message'];
    echo '<div class="flex items-center justify-center mt-6">  
     <div id="successMessage" class="flex w-96 shadow-lg rounded-lg">
         <div class="bg-green-600 py-4 px-6 rounded-l-lg flex items-center">
             <i class="fas fa-check text-white"></i>
         </div>
        <div class="relative px-4 py-6 bg-white rounded-r-lg flex justify-between items-center w-full border border-l-transparent border-gray-200">
            <div>' . $successMessage . '</div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-green-600"></div>
        </div>
    </div>
</div>';


    unset($_SESSION['success_message']);
  }


  if (isset($_SESSION['error_message'])) {

    $errorMessage = $_SESSION['error_message'];
    echo '<div class="flex items-center justify-center mt-6">  
     <div id="errorMessage" class="flex w-96 shadow-lg rounded-lg">
         <div class="bg-red-600 py-4 px-6 rounded-l-lg flex items-center">
             <i class="fas fa-times text-white"></i>
         </div>
        <div class="relative px-4 py-6 bg-white rounded-r-lg flex justify-between items-center w-full border border-l-transparent border-gray-200">
            <div>' . $errorMessage . '</div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-red-600"></div>
        </div>
    </div>
</div>';

    unset($_SESSION['error_message']);
  }
  ?>
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
<script src="../../../include/index.js"></script>


</body>

</html>