<?php

session_start();
ob_start();

include("../../../../database/config.php");
include("../../../include/adminNavbar.php");


?>
<div class="flex flex-col min-h-screen w-full">

  <?php
  // Handle batch deletion
  if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["batch_id"])) {
    $batch_id = $_GET["batch_id"];
    header("Location: delete.php?action=delete&batch_id=$batch_id");
    exit;
  }
  ?>
  <?php
  // if update,  this alart will show
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
  // if delete, this alart will show
  if (isset($_SESSION['delete'])) {
    $msg = $_SESSION['delete'];

    echo '<div class="flex items-center justify-center mt-6">  
         <div id="successMessage" class="flex w-96 shadow-lg rounded-lg">
             <div class="bg-green-600 py-4 px-6 rounded-l-lg flex items-center">
                 <i class="fas fa-check text-white"></i>
             </div>
            <div class="relative px-4 py-6 bg-white rounded-r-lg flex justify-between items-center w-full border border-l-transparent border-gray-200">
                <div>' . $msg . '</div>
                <div class="absolute bottom-0 left-0 w-full h-1 bg-green-600"></div>
            </div>
        </div>
    </div>';
    unset($_SESSION['delete']);
  }

  if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    echo '<div class="flex items-center justify-center mt-6">  
    <div id="errorMessage" class="flex w-96 shadow-lg rounded-lg">
        <div class="bg-red-600 py-4 px-6 rounded-l-lg flex items-center">
            <i class="fas fa-times text-white"></i>
        </div>
        <div class="relative px-4 py-6 bg-white rounded-r-lg flex justify-between items-center w-full border border-l-transparent border-gray-200">
            <div>' . $error . '</div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-red-600"></div>
        </div>
    </div>
</div>';


    unset($_SESSION['error']);
  } ?>

  <div class="flex justify-between my-4 ">
    <p class="border border-black">
      <a href="../../add/batch/add_batch.php"
        class="inline-block px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-600 hover:no-underline">
        Add Batch
      </a>
    </p>


    <form method="post" class="flex">
      <input type="text" name="search"
        class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
        placeholder="Search by batch number or department">
      <button type="submit" class="ml-2 bg-gray-900 hover:bg-gray-600 text-white py-2 px-4 rounded"><i
          class="fa fa-search" aria-hidden="true"></i></button>
    </form>
  </div>



  <?php
  // Fetch batch information
  $sql_batches = "SELECT * FROM Batch";

  // Check if a POST request is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    $search = $_POST["search"];
    // Modify the SQL query for search
    $sql_batches = "SELECT * FROM Batch 
                  WHERE batch_number LIKE '%$search%' 
                  OR department_id IN (SELECT department_id FROM Department WHERE department_name LIKE '%$search%')";
  }

  $result_batches = $conn->query($sql_batches);
  ?>
  <div>
    <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
      <thead class="bg-gray-200">
        <tr>
          <th class="px-4 py-2">Serial No</th>
          <th class="px-4 py-2">Batch Number</th>
          <th class="px-4 py-2">Department</th>
          <th class="px-4 py-2">Shift</th>
          <th class="px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result_batches->num_rows > 0) {
          $count = 1;
          while ($row = $result_batches->fetch_assoc()) {
            $batch_id = $row['batch_id'];
            $batch_number = $row['batch_number'];
            $department_id = $row['department_id'];
            $batch_shift = $row['batch_shift'];

            // Fetch department name
            $sql_department = "SELECT department_name FROM Department WHERE department_id = $department_id";
            $result_department = $conn->query($sql_department);
            $department_name = $result_department->fetch_assoc()['department_name'];
            ?>

            <tr>
              <td class="border px-4 py-2">
                <?php echo $count; ?>
              </td>
              <td class="border px-4 py-2">
                <?php echo $batch_number; ?>
              </td>
              <td class="border px-4 py-2">
                <?php echo $department_name; ?>
              </td>
              <td class="border capitalize  px-4 py-2">
                <?php echo $batch_shift; ?>
              </td>
              <td class="border px-4 py-2">
                <a href="edit_batch.php?batch_id=<?php echo $batch_id; ?>"
                  class="text-blue-500 text-black mr-2 hover:text-black"><i class="fa fa-pencil-square"
                    aria-hidden="true"></i></a>
                <a href="?action=delete&batch_id=<?php echo $batch_id; ?>" class="text-red-500 hover:text-black"
                  onclick="return confirm('Are you sure you want to delete this batch?')"><i class="fa fa-trash"
                    aria-hidden="true"></i></a>
              </td>
            </tr>

            <?php
            $count++;
          }
        } else {
          echo "<tr><td colspan='5' class='border px-4 py-2 text-center'>No batches found.</td></tr>";
        }
        ?>
      </tbody>
    </table>
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