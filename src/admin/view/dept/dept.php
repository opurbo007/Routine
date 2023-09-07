<?php

session_start();
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



  <!-- search logic -->
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    $search_query = $_POST["search"];
    $sql = "SELECT * FROM Department WHERE department_name LIKE '%$search_query%'";
  } else {
    $sql = "SELECT * FROM Department";
  }

  $result = $conn->query($sql);
  ?>



  <!-- add butto & search  -->
  <div class="flex justify-between my-4 ">
    <p class="border border-black">
      <a href="../../add/dept/add_department.php"
        class="inline-block px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-600 hover:no-underline">
        Add Department
      </a>
    </p>
    <!-- Search form -->
    <form method="post" class="flex">
      <input type="text" name="search" placeholder="Search by department name"
        class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
      <button type="submit" value="Search" class="ml-2 bg-gray-900 hover:bg-gray-600 text-white py-2 px-4 rounded"><i
          class="fa fa-search" aria-hidden="true"></i></button>
    </form>
  </div>




  <!-- Display departments -->
  <div>
    <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
      <thead class="bg-gray-200">
        <tr>
          <th class="px-4 py-2">Department ID</th>
          <th class="px-4 py-2">Department Name</th>
          <th class="px-4 py-2">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($department = $result->fetch_assoc()) { ?>
          <tr>
            <td class="border px-4 py-2">
              <?php echo $department["department_id"]; ?>
            </td>
            <td class="border px-4 py-2">
              <?php echo $department["department_name"]; ?>
            </td>
            <td class="border px-4 py-2">
              <a href="edit_dept.php?id=<?php echo $department["department_id"]; ?>"
                class="text-blue-500 text-black mr-4 hover:text-black"><i class="fa fa-pencil-square"
                  aria-hidden="true"></i></a>
              <a href="delete.php?id=<?php echo $department["department_id"]; ?>" class="text-red-500 hover:text-black"
                onclick="return confirm('Are you sure you want to delete this department?')">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>

            </td>
          </tr>
        <?php } ?>
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