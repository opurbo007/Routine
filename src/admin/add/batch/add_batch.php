<?php

include("../../../include/auth.php");

include("../../../../database/config.php");
include("../../../include/adminNavbar.php");


?>
<div class="flex flex-col min-h-screen w-full">

    <?php
    if (isset($_SESSION['exist'])) {
        $existmsg = $_SESSION['exist'];

        echo '<div class="flex items-center justify-center mt-6">  
      <div id="errorMessage" class="flex w-96 shadow-lg rounded-lg">
          <div class="bg-red-600 py-4 px-6 rounded-l-lg flex items-center">
              <i class="fas fa-times text-white"></i>
          </div>
          <div class="relative px-4 py-6 bg-white rounded-r-lg flex justify-between items-center w-full border border-l-transparent border-gray-200">
              <div>' . $existmsg . '</div>
              <div class="absolute bottom-0 left-0 w-full h-1 bg-red-600"></div>
          </div>
      </div>
  </div>';
        unset($_SESSION['exist']);
    }
    // Check if the success message session variable is set
    if (isset($_SESSION['success_message'])) {
        // Display the success message
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

        // Clear the session variable
        unset($_SESSION['success_message']);
    }

    // Check if the error message session variable is set (if needed)
    if (isset($_SESSION['error_message'])) {
        // Display the error message
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

        // Clear the session variable
        unset($_SESSION['error_message']);
    }



    // Fetch departments for dropdown
    $sql_departments = "SELECT * FROM Department";
    $result_departments = $conn->query($sql_departments);
    ?>

    <div class="flex items-center justify-center flex-grow-2">

        <div
            class="relative mx-auto w-full max-w-md bg-white px-6 pt-10 mt-24 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:rounded-xl sm:px-10">
            <div class="w-full">
                <div class="text-center">
                    <h1 class="text-2xl font-semibold text-gray-900">Add Batch</h1>
                </div>
                <div class="mt-5">
                    <form method="post" action="insert.php">
                        <div class="relative mt-6">

                            <input type="text" id="batch_number" name="batch_number" required
                                class="peer mt-1 w-full border-b-2 border-gray-300 px-0 py-1 placeholder:text-transparent focus:border-gray-500 focus:outline-none"
                                autocomplete="NA" placeholder="Batch Number:">
                            <label for="batch_number"
                                class="pointer-events-none absolute top-0 left-0 origin-left -translate-y-1/2 transform text-sm text-gray-800 opacity-75 transition-all duration-100 ease-in-out peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Batch
                                Number:</label>
                        </div>


                        <!-- <label for="department_id">Select Department:</label> -->
                        <div class="relative mt-6 ">
                            <select id="department_id" name="department_id" required
                                class="w-full text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-gray-300">
                                <option value="" disabled selected class="bg-white py-2 hover:bg-gray-100">Select a
                                    department</option>
                                <?php
                                if ($result_departments->num_rows > 0) {
                                    while ($row = $result_departments->fetch_assoc()) {
                                        $department_id = $row['department_id'];
                                        $department_name = $row['department_name'];
                                        echo "<option value='$department_id'>$department_name</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="relative mt-6 ">
                            <div class="main flex border w-full rounded-full overflow-hidden my-4 select-none">
                                <div class="title py-3 my-auto px-5 bg-gray-900 text-white text-sm font-semibold mr-3">
                                    S H I F T</div>
                                <label for="day" class="flex radio p-2 cursor-pointer">
                                    <input type="radio" id="day" name="batch_shift" value="day" required
                                        class="my-auto transform scale-125">
                                    <div class="title px-2">Day</div>
                                </label>

                                <label for="evening" class="flex radio p-2 cursor-pointer">
                                    <input type="radio" id="evening" name="batch_shift" value="evening" required
                                        class="my-auto transform scale-125">

                                    <div class="title px-2">Evening</div>
                                </label>
                            </div>
                        </div>
                        <div class=" my-6">
                            <input type="submit" value="Add Batch"
                                class="w-full rounded-md bg-gray-900 px-3 py-2 text-white focus:bg-gray-400 focus:outline-none">
                        </div>
                </div>
                </form>
                <p class="text-center text-sm text-gray-500">
                    View All Batch <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                    <a class="underline" href="../../view/batch/batch.php">Here</a>
                </p>
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