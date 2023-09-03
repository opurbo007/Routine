<?php

session_start();
ob_start();

include("../../../../database/config.php");
include("../../../include/adminNavbar.php");


?>
<div class="flex flex-col min-h-screen w-full">

  <?php
  $department_id = $_GET["id"];

  // Fetch department details
  $sql_fetch_department = "SELECT * FROM Department WHERE department_id = $department_id";
  $result_fetch_department = $conn->query($sql_fetch_department);

  $department_name = "";
  if ($result_fetch_department->num_rows > 0) {
    $row = $result_fetch_department->fetch_assoc();
    $department_name = $row["department_name"];
  }

  // Handle the form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updated_department_name = $_POST["updated_department_name"];

    //update dept
    $sql_update_department = "UPDATE Department SET department_name = '$updated_department_name' WHERE department_id = $department_id";
    $conn->query($sql_update_department);

    if ($conn->query($sql_update_department) === TRUE) {

      $_SESSION['success_message'] = "Successfully Department Updated";

    } else {
      $_SESSION['error_message'] = "Error! Department Not updated";
    }
    header('Location: dept.php');
    exit;
  }

  ?>


  <div class="flex items-center justify-center flex-grow-2">

    <div
      class="relative mx-auto w-full max-w-md bg-white px-6 pt-10 mt-24 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:rounded-xl sm:px-10">
      <div class="w-full">
        <div class="text-center">
          <h1 class="text-2xl font-semibold text-gray-900">Update Department</h1>
        </div>
        <div class="mt-5">
          <form method="post">
            <input type="hidden" name="update_id" value="<?php echo $department_id; ?>">
            <div class="relative mt-6">
              <label for="updated_department_name" class="block text-sm font-medium text-gray-700">Department
                Name:</label>
              <input type="text" id="updated_department_name" name="updated_department_name"
                value="<?php echo $department_name; ?>" required
                class="mt-1 p-2 block w-full rounded-md bg-gray-100 border border-gray-300">
            </div>
            <div class="my-6">
              <button type="submit" value="Update Department"
                class="w-full rounded-md bg-gray-900 px-3 py-2 text-white focus:bg-gray-400 focus:outline-none"> Update
                Department</button>
            </div>

          </form>
          <p class="text-center text-sm text-gray-500">
            View All Batch <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
            <a class="underline" href="./dept.php">Here</a>
          </p>
        </div>
      </div>
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