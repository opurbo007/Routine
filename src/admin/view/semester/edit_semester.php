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
    $semester_id = $_POST["semester_id"];
    $semester_name = $_POST["semester_name"];
    $department_id = $_POST["department_id"];

    // Update the semester in the Semester table
    $sql_update_semester = "UPDATE Semester SET semester_name = '$semester_name', department_id = $department_id WHERE semester_id = $semester_id";

    if ($conn->query($sql_update_semester) === TRUE) {
      $_SESSION['success_message'] = "Successfully Semester Updated";
    } else {

      $_SESSION['error_message'] = "Error! Semester Not updated";
    }
    header('Location: semester.php');
    exit;
  }
  if (isset($_GET["semester_id"])) {
    // Retrieve the semester details
    $semester_id = $_GET["semester_id"];
    $sql_get_semester = "SELECT * FROM Semester WHERE semester_id = $semester_id";
    $result_get_semester = $conn->query($sql_get_semester);

    if ($result_get_semester->num_rows > 0) {
      $row = $result_get_semester->fetch_assoc();
      $semester_name = $row["semester_name"];
      $department_id = $row["department_id"];
    }

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
          <h1 class="text-2xl font-semibold text-gray-900">Update Batch</h1>
        </div>
        <div class="mt-5">
          <form method="post">
            <input type="hidden" name="semester_id" value="<?php echo $semester_id; ?>">
            <div class="relative mt-6">
              <label for="semester_name" class="block text-sm font-medium text-gray-700">Semester Name:</label>
              <input type="text" id="semester_name" name="semester_name" value="<?php echo $semester_name; ?>" required
                class="mt-1 p-2 block w-full rounded-md bg-gray-100 border border-gray-300">
            </div>
            <div class="relative mt-6">
              <!-- <label for="department_id">Select Department:</label> -->
              <select id="department_id" name="department_id" required
                class="w-full text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-gray-300">
                <?php
                if ($result_departments->num_rows > 0) {
                  while ($row = $result_departments->fetch_assoc()) {
                    $dept_id = $row['department_id'];
                    $dept_name = $row['department_name'];
                    $selected = ($dept_id == $department_id) ? 'selected' : '';
                    echo "<option value='$dept_id' $selected >$dept_name</option>";
                  }
                }
                ?>
              </select>
            </div>
            <div class=" my-6">
              <input type="submit" value="Update Semester"
                class="w-full rounded-md bg-gray-900 px-3 py-4 text-white focus:bg-gray-400 focus:outline-none">
            </div>

          </form>
          <p class="text-center text-sm text-gray-500">
            View All Semester <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
            <a class="underline" href="./semester.php">Here</a>
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