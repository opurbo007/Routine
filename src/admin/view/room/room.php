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

  <div class="flex justify-between my-4 ">
    <p class="border border-black">
      <a href="../../add/room/add_room.php"
        class="inline-block px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-600 hover:no-underline">
        Add Room
      </a>
    </p>


    <form method="post" class="flex">
      <input type="text" name="search" placeholder="Search by room number or type"
        class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
      <button type="submit" value="Search" class="ml-2 bg-gray-900 hover:bg-gray-600 text-white py-2 px-4 rounded"><i
          class="fa fa-search" aria-hidden="true"></i></button>
    </form>
  </div>


  <?php
  // Handle search
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    $search = $_POST["search"];

    // Search for rooms based on room number or room type
    $sql_search = "SELECT * FROM Room WHERE room_number LIKE '%$search%' OR room_type LIKE '%$search%'";
    $result_search = $conn->query($sql_search);
  } else {
    // Fetch all rooms
    $sql_all_rooms = "SELECT * FROM Room";
    $result_all_rooms = $conn->query($sql_all_rooms);
  }

  ?>

  <div>
    <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
      <thead class="bg-gray-200">
        <tr>

          <th class="px-4 py-2">Room Number</th>
          <th class="px-4 py-2">Room Type</th>
          <th class="px-4 py-2">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $result = isset($result_search) ? $result_search : $result_all_rooms;

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
              <td class="border px-4 py-2">
                <?php echo $row['room_number']; ?>
              </td>
              <td class="border px-4 py-2">
                <?php echo $row['room_type']; ?>
              </td>
              <td class="border px-4 py-2"><a href='edit_room.php?room_id=<?php echo $row['room_id'] ?>' class="text-blue-500 text-black mr-4
                  hover:text-black"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                <a href='delete.php?room_id= <?php echo $row['room_id']; ?>' class="text-red-500 hover:text-black"
                  onclick="return confirm('Are you sure you want to delete this Room?')">
                  <i class="fa fa-trash" aria-hidden="true"></i>
                </a>
              </td>
            </tr>
            <?php
          }
        } else {
          echo "<tr><td colspan='3' class='text-center'>No rooms found</td></tr>";
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