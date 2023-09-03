<?php

session_start();
ob_start();

include("../../../../database/config.php");
include("../../../include/adminNavbar.php");


?>
<div class="flex flex-col min-h-screen w-full">

  <?php
        // Handle the form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $batch_id = $_POST["batch_id"];
            $batch_number = $_POST["batch_number"];
            $department_id = $_POST["department_id"];
            $batch_shift = $_POST["batch_shift"];

            // Update the batch information
            $sql_update_batch = "UPDATE Batch SET batch_number = '$batch_number', department_id = $department_id, batch_shift = '$batch_shift' WHERE batch_id = $batch_id";

            if ($conn->query($sql_update_batch) === TRUE) {
                $_SESSION['success_message'] = "Successfully Batch Updated";
              } else {
          
                $_SESSION['error_message'] = "Error! Batch Not updated";
              }
              header('Location: batch.php');
              exit;
        }

        // Fetch batch information based on batch_id parameter
        if (isset($_GET["batch_id"])) {
            $batch_id = $_GET["batch_id"];
            $sql_fetch_batch = "SELECT * FROM Batch WHERE batch_id = $batch_id";
            $result_fetch_batch = $conn->query($sql_fetch_batch);
            $batch_data = $result_fetch_batch->fetch_assoc();
        }

        // Fetch department information
        $sql_departments = "SELECT * FROM Department";
        $result_departments = $conn->query($sql_departments);
        ?>

    <div class="flex items-center justify-center flex-grow-2">

    <div
    class="relative mx-auto w-full max-w-md bg-white px-6 pt-10 mt-24 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:rounded-xl sm:px-10">
    <div class="w-full">
        <div class="text-center">
            <h1 class="text-2xl font-semibold text-gray-900">Update Batch</h1>
        </div>
     <div class="mt-5">
        <form method="post">
            <input type="hidden" name="batch_id" value="<?php echo $batch_id; ?>">
            <div class="relative mt-6">
                <label class="block text-sm font-medium text-gray-700">Batch Number</label>
                <input type="text" name="batch_number" value="<?php echo $batch_data['batch_number']; ?>"
                       class="mt-1 p-2 block w-full rounded-md bg-gray-100 border border-gray-300">
            </div>
            <div class="relative mt-6">
                <label class="block text-sm font-medium text-gray-700">Select Department</label>
                <select name="department_id" class="mt-1 p-2 block w-full rounded-md bg-gray-100 border border-gray-300">
                    <?php
                    if ($result_departments->num_rows > 0) {
                        while ($row = $result_departments->fetch_assoc()) {
                            $department_id = $row['department_id'];
                            $department_name = $row['department_name'];
                            $selected = ($department_id == $batch_data['department_id']) ? 'selected' : '';
                            echo "<option value='$department_id' $selected>$department_name</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="relative mt-6 ">
                        <div class="main flex border w-full rounded-full overflow-hidden my-4 select-none">
                                <div class="title py-3 my-auto px-5 bg-gray-900 text-white text-sm font-semibold mr-3">
                                    S H I F T
                                </div>
                                       <label for="day" class="flex radio p-2 cursor-pointer">
                                            <input  class="my-auto transform scale-125" type="radio" id="day" name="batch_shift" value="day"
                                             <?php if ($batch_data['batch_shift'] == 'day') echo 'checked'; ?>>
                                            <div class="title px-2">Day</div>
                                        </label>
                                        <label for="evening" class="flex radio p-2 cursor-pointer">
                                            <input  class="my-auto transform scale-125" type="radio" id="evening" name="batch_shift" value="evening"
                                            <?php if ($batch_data['batch_shift'] == 'evening') echo 'checked'; ?>>
                                            <div class="title px-2">Evening</div>
                                        </label>
                            </div>
                </div>
                <div class= "my-6">
                    <button type="submit" class="w-full rounded-md bg-gray-900 px-3 py-2 text-white focus:bg-gray-400 focus:outline-none">
                      Update Batch
                    </button>
                </div>
            </div>
        </form>
              <p class="text-center text-sm text-gray-500">
                    View All Batch <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                    <a class="underline" href="./batch.php">Here</a>
                </p>
                
        </div>
    </div>
</div>
<?php
  $conn->close();
  ob_end_flush();
?>
</div>
<script src="../../../include/index.js"></script>


</body>

</html>