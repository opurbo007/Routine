<?php
include("../../../include/auth.php");
ob_start();

include("../../../../database/config.php");
include("../../../include/adminNavbar.php");


?>
<div class="flex flex-col min-h-screen w-full">

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
      <a href="../../add/semester/add_semester.php"
        class="inline-block px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-600 hover:no-underline">
        Add Semester
      </a>
    </p>



    <form action="" method="get">
      <!-- <label for="search_department">Search by Department:</label> -->
      <select id="search_department" name="search_department"
        class="text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
        <option value="" class="bg-white py-2 hover:bg-gray-100">All Departments</option>
        <?php
        // Fetch departments for dropdown
        $sql_departments = "SELECT * FROM Department";
        $result_departments = $conn->query($sql_departments);

        if ($result_departments->num_rows > 0) {
          while ($row = $result_departments->fetch_assoc()) {
            $department_id = $row['department_id'];
            $department_name = $row['department_name'];
            $selected = ($_GET['search_department'] == $department_id) ? 'selected' : '';
            echo "<option value='$department_id' $selected>$department_name</option>";
          }
        }
        ?>
      </select>
      <button type="submit" value="Search" class="ml-2 bg-gray-900 hover:bg-gray-600 text-white py-2 px-4 rounded"><i
          class="fa fa-search" aria-hidden="true"></i>
      </button>
    </form>
  </div>

  <!-- Display departments -->
  <div>
    <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
      <thead class="bg-gray-200">
        <tr>
          <th class="px-4 py-2">Semester Name</th>
          <th class="px-4 py-2">Department</th>
          <th class="px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $search_department = $_GET['search_department'] ?? '';

        $sql_semesters = "SELECT Semester.*, Department.department_name FROM Semester
                     LEFT JOIN Department ON Semester.department_id = Department.department_id";

        if (!empty($search_department)) {
          $sql_semesters .= " WHERE Semester.department_id = $search_department";
        }

        $result_semesters = $conn->query($sql_semesters);

        if ($result_semesters->num_rows > 0) {
          while ($row = $result_semesters->fetch_assoc()) {
            $semester_id = $row['semester_id'];
            $semester_name = $row['semester_name'];
            $department_name = $row['department_name'];
            ?>
            <tr>
              <td class="border px-4 py-2">
                <?php echo $semester_name ?>
              </td>
              <td class="border px-4 py-2">
                <?php echo $department_name ?>
              </td>
              <td class="border px-4 py-2">
                <a href='edit_semester.php?action=edit&semester_id=<?= $semester_id ?>'
                  class="text-blue-500 text-black mr-4 hover:text-black"><i class="fa fa-pencil-square"
                    aria-hidden="true"></i></a>

                <a href='delete.php?action=delete&semester_id=<?= $semester_id ?>' class='text-red-500 hover:text-black'
                  onclick='return confirm("Are you sure you want to delete this semester?");'>
                  <i class='fa fa-trash' aria-hidden='true'></i>
                </a>
              </td>

              </td>
            </tr>
            <?php
          }
        } else {
          echo "<tr><td colspan='3' class='text-center'>No semesters found.</td></tr>";

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