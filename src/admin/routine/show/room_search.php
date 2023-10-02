<?php
session_start();
include("../../../../database/config.php");
include("../../../include/adminNavbar.php");
?>


<div class="flex flex-col min-h-screen w-full">

  <div class="flex items-center justify-center flex-grow-2">

    <div
      class="relative mx-auto w-full max-w-md bg-white px-6 pt-10 mt-24 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:rounded-xl sm:px-10">
      <div class="w-full">
        <div class="text-center">
          <h1 class="text-2xl font-semibold text-gray-900">Avilable Room</h1>
        </div>
        <div class="mt-5">
          <form method="post" action="room_search_result.php">
            <div class="relative mt-6">
              <label for="day">Select Day:</label>
              <select name="day" id="day"
                class="w-full text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-gray-300">
                <option value="Saturday">Saturday </option>
                <option value="Sunday">Sunday </option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
              </select>
            </div>
            <div class="relative mt-6 ">
              <label for="time">Select
                Time:</label>
              <input type="time" name="time" id="time" placeholder="HH:MM" required
                class="peer mt-1 w-full border-b-2 border-gray-300 px-0 py-1 placeholder:text-transparent focus:border-gray-500 focus:outline-none"
                autocomplete="NA">
            </div>
            <div class="mt-5">

              <input type="submit" name="search_room" value="Check Room Availability"
                class="w-full rounded-md bg-gray-900 px-3 py-2 text-white focus:bg-gray-400 focus:outline-none">
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php
  $conn->close();
  ?>
</div>
<script src="../../../include/index.js"></script>


</body>

</html>