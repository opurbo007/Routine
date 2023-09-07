<?php

session_start();
ob_start();

include("../../../../database/config.php");
include("../../../include/adminNavbar.php");


// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["room_id"]) && isset($_POST["room_number"]) && isset($_POST["room_type"])) {
  $room_id = $_POST["room_id"];
  $room_number = $_POST["room_number"];
  $room_type = $_POST["room_type"];

  // Update the room details in the Room table
  $sql_update_room = "UPDATE Room SET room_number = '$room_number', room_type = '$room_type' WHERE room_id = $room_id";

  if ($conn->query($sql_update_room) === TRUE) {
    $_SESSION['success_message'] = "Successfully room Updated";
  } else {

    $_SESSION['error_message'] = "Error! room Not updated";
  }
  header('Location: room.php');
  exit;
} elseif (isset($_GET["room_id"])) {
  $room_id = $_GET["room_id"];

  // Fetch room data
  $sql_room = "SELECT * FROM Room WHERE room_id = $room_id";
  $result_room = $conn->query($sql_room);

  if ($result_room->num_rows == 1) {
    $row = $result_room->fetch_assoc();
    $room_number = $row['room_number'];
    $room_type = $row['room_type'];
  } else {
    echo "<p>Error: Room not found.</p>";
    exit;
  }
} else {
  echo "<p>Error: Room ID not provided.</p>";
  exit;
}

?>
<div class="flex flex-col min-h-screen w-full">
  <div class="flex items-center justify-center flex-grow-2">

    <div
      class="relative mx-auto w-full max-w-md bg-white px-6 pt-10 mt-24 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:rounded-xl sm:px-10">
      <div class="w-full">
        <div class="text-center">
          <h1 class="text-2xl font-semibold text-gray-900">Update Course</h1>
        </div>
        <div class="mt-5">
          <form method="post">

            <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
            <div class="relative mt-6">
              <label for="room_number" class="block text-sm font-medium text-gray-700">Room Number:</label>
              <input type="text" id="room_number" name="room_number" value="<?php echo $room_number; ?>" required
                class="mt-1 p-2 block w-full rounded-md bg-gray-100 border border-gray-300">
            </div>
            <div class="relative mt-6">
              <div class="main flex border w-full rounded-full overflow-hidden my-4 select-none">
                <div class="title py-3 my-auto px-5 bg-gray-900 text-white text-sm font-semibold mr-3">
                  T Y P E
                </div>
                <label for="theory" class="flex radio p-2 cursor-pointer">
                  <input type="radio" id="theory" name="room_type" value="theory" <?php if ($room_type === 'theory')
                    echo 'checked'; ?> required class="my-auto transform scale-125">
                  <div class="title px-2">Theory</div>
                </label>
                <label for="lab" class="flex radio p-2 cursor-pointer">
                  <input type="radio" id="lab" name="room_type" value="lab" <?php if ($room_type === 'lab')
                    echo 'checked'; ?> required class="my-auto transform scale-125">
                  <div class="title px-2">LAB</div>
                </label>
              </div>
            </div>
            <div class=" my-6">
              <input type="submit" value="Update Room"
                class="w-full rounded-md bg-gray-900 px-3 py-2 text-white focus:bg-gray-400 focus:outline-none">
            </div>
          </form>
          <p class="text-center text-sm text-gray-500">
            View All Room <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
            <a class="underline" href="./room.php">Here</a>
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