<?php
include("../../../include/auth.php");
ob_start();

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
      <a href="../../add/time/add_timetable.php"
        class="inline-block px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-600 hover:no-underline">
        Add Timeslot
      </a>
    </p>

    <form action="" method="get">
      <!-- <label for="search_class_type">Search by Class Type:</label> -->
      <select id="search_class_type" name="search_class_type"
        class="text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
        <option value="" class="bg-white py-2 hover:bg-gray-100">All Class Types</option>
        <option value="theory" class="bg-white py-2 hover:bg-gray-100">Theory</option>
        <option value="lab" class="bg-white py-2 hover:bg-gray-100">Lab</option>
      </select>
      <button type="submit" value="Search" class="ml-2 bg-gray-900 hover:bg-gray-600 text-white py-2 px-4 rounded"><i
          class="fa fa-search" aria-hidden="true"></i>
      </button>
    </form>

  </div>
  <div>
    <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
      <thead class="bg-gray-200">
        <tr>
          <th class="px-4 py-2">Start Time</th>
          <th class="px-4 py-2">End Time</th>
          <th class="px-4 py-2">Class Type</th>
          <th class="px-4 py-2">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $search_class_type = $_GET['search_class_type'] ?? '';
        $sql_timetable = "SELECT * FROM timeslot";
        if (!empty($search_class_type)) {
          $sql_timetable .= " WHERE class_type = '$search_class_type'";
        }

        $result_timetable = $conn->query($sql_timetable);

        if ($result_timetable->num_rows > 0) {
          while ($row = $result_timetable->fetch_assoc()) {
            $timetable_id = $row['timetable_id'];
            $start_time = $row['start_time'];
            $end_time = $row['end_time'];
            $class_type = $row['class_type'];
            ?>

            <tr>
              <td class="border px-4 py-2">
                <?php echo $start_time ?>
              </td>
              <td class="border px-4 py-2">
                <?php echo $end_time ?>
              </td>
              <td class="border px-4 py-2">
                <?php echo $class_type ?>
              </td>
              <td class="border px-4 py-2">
                <a href='edit_timetable.php?action=edit&timetable_id=<?php echo $timetable_id ?>' class="text-blue-500
                  text-black mr-4 hover:text-black"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>


                <a href='delete.php?action=delete&timetable_id=<?php echo $timetable_id ?>'
                  class='text-red-500 hover:text-black'
                  onclick='return confirm("Are you sure you want to delete this TImeslot?");'>
                  <i class='fa fa-trash' aria-hidden='true'></i>
                </a>
              </td>
            </tr>
            <?php
          }
        } else {
          echo "<tr><td colspan='4' class='text-center'>No timeSLot entries found.</td></tr>";
        }

        ?>

      </tbody>
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