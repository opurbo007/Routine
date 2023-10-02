<?php
session_start();
include("../../../../database/config.php");
include("../../../include/adminNavbar.php");

if (isset($_POST['search_room'])) {
  $selectedDay = $_POST['day'];
  $selectedTime = $_POST['time'];

  // available regular rooms
  $regularRoomQuery = "SELECT r.room_number, r.room_type
    FROM room r
    WHERE r.room_id NOT IN (
      SELECT room_id FROM routine
      WHERE day = ?
      AND start_time <= ? 
      AND end_time >= ?
    ) AND r.room_type = 'theory'";

  $stmt = $conn->prepare($regularRoomQuery);
  $stmt->bind_param("sss", $selectedDay, $selectedTime, $selectedTime);
  $stmt->execute();
  $regularRoomResult = $stmt->get_result();

  // available lab rooms
  $labRoomQuery = "SELECT r.room_number, r.room_type
    FROM room r
    WHERE r.room_id NOT IN (
      SELECT room_id FROM routine
      WHERE day = ?
      AND start_time <= ? 
      AND end_time >= ?
    ) AND r.room_type = 'Lab'";

  $stmt = $conn->prepare($labRoomQuery);
  $stmt->bind_param("sss", $selectedDay, $selectedTime, $selectedTime);
  $stmt->execute();
  $labRoomResult = $stmt->get_result();

  if ($regularRoomResult->num_rows > 0 || $labRoomResult->num_rows > 0) {
    ?>

<div class="flex flex-col min-h-screen w-full bg-gray-100">
  <div class="flex items-center justify-center flex-grow-2">

    <div
      class="relative mx-auto w-full max-w-3xl bg-white px-6 pt-10 mt-24 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:rounded-xl sm:px-10">
      <div class="w-full">
        <div class="text-center">
          <h1 class="text-2xl font-semibold text-gray-900">Available Rooms</h1>
        </div>
        <div class="mt-5 flex space-x-4">
          <?php
              if ($regularRoomResult->num_rows > 0) {
                ?>
          <div class="w-1/2 mx-auto">
            <h2 class="text-xl text-center font-semibold mb-2">Regular Rooms</h2>
            <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
              <thead class="bg-gray-200">
                <tr>
                  <th class="px-4 py-2">Room Number</th>
                  <th class="px-4 py-2">Room Type</th>
                </tr>
              </thead>
              <tbody>
                <?php
                      while ($row = $regularRoomResult->fetch_assoc()) {
                        ?>
                <tr>
                  <td class="border px-4 py-2">
                    <?php echo $row['room_number'] ?>
                  </td>
                  <td class="border px-4 py-2">
                    <?php echo $row['room_type'] ?>
                  </td>
                </tr>
                <?php
                      }
                      ?>
              </tbody>
            </table>
          </div>
          <?php
              }

              // Display available lab rooms in a table
              if ($labRoomResult->num_rows > 0) {
                ?>
          <div class="w-1/2 mx-auto">
            <h2 class="text-xl text-center  font-semibold mb-2">Lab Rooms</h2>
            <table class="table-auto w-full bg-white ml-2 shadow-md rounded-lg overflow-hidden">
              <thead class="bg-gray-200">
                <tr>
                  <th class="px-4 py-2">Room Number</th>
                  <th class="px-4 py-2">Room Type</th>
                </tr>
              </thead>
              <tbody>
                <?php
                      while ($row = $labRoomResult->fetch_assoc()) {
                        ?>
                <tr>
                  <td class="border px-4 py-2">
                    <?php echo $row['room_number'] ?>
                  </td>
                  <td class="border px-4 py-2">
                    <?php echo $row['room_type'] ?>
                  </td>
                </tr>
                <?php
                      }
                      ?>
              </tbody>
            </table>
          </div>
          <?php
              }
              ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } else { ?>
<div class="flex flex-col min-h-screen w-full bg-gray-100">
  <div class="flex items-center justify-center flex-grow-2">
    <div
      class="relative mx-auto w-full max-w-3xl bg-white px-6 pt-10 mt-24 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:rounded-xl sm:px-10">
      <div class="w-full">
        <div class="text-center">
          <h1 class="text-2xl font-semibold text-gray-900">No rooms available for the selected day and time</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<?php }
  $stmt->close();
}
?>
</div>
<script src="../../../include/index.js"></script>


</body>

</html>