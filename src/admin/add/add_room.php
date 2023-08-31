<?php
include("../../../database/config.php");
include("../../include/adminNavbar.php");
?>

<div class="flex flex-col min-h-screen w-full">

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["room_number"]) && isset($_POST["room_type"])) {
        $room_number = $_POST["room_number"];
        $room_type = $_POST["room_type"];

        // Insert the new room into the Room table
        $sql_insert_room = "INSERT INTO Room (room_number, room_type) VALUES ('$room_number', '$room_type')";

        if ($conn->query($sql_insert_room) === TRUE) {
            echo '<div class="flex items-center justify-center mt-6">  
                <div id="successMessage" class="flex w-96 shadow-lg rounded-lg">
                    <div class="bg-green-600 py-4 px-6 rounded-l-lg flex items-center">
                        <i class="fas fa-check text-white"></i>
                    </div>
                    <div class="relative px-4 py-6 bg-white rounded-r-lg flex justify-between items-center w-full border border-l-transparent border-gray-200">
                        <div>Successfully Batch Added</div>
                        <div class="absolute bottom-0 left-0 w-full h-1 bg-green-600"></div>
                    </div>
                </div>
            </div>';
        } else {
            echo '<div class="flex items-center justify-center mt-6">  
            <div id="errorMessage" class="flex w-96 shadow-lg rounded-lg">
                <div class="bg-red-600 py-4 px-6 rounded-l-lg flex items-center">
                    <i class="fas fa-times text-white"></i>
                </div>
                <div class="relative px-4 py-6 bg-white rounded-r-lg flex justify-between items-center w-full border border-l-transparent border-gray-200">
                    <div>Error ! Batch Not Add</div>
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-red-600"></div>
                </div>
            </div>
        </div>';
        }
    }
    ?>


    <div class="flex items-center justify-center flex-grow-2">

        <div
            class="relative mx-auto w-full max-w-md bg-white px-6 pt-10 mt-24 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:rounded-xl sm:px-10">
            <div class="w-full">
                <div class="text-center">
                    <h1 class="text-2xl font-semibold text-gray-900">Add Batch</h1>
                </div>
                <div class="mt-5">
                    <form method="post">
                        <div class="relative mt-6">

                            <input type="text" id="room_number" name="room_number" required
                                class="peer mt-1 w-full border-b-2 border-gray-300 px-0 py-1 placeholder:text-transparent focus:border-gray-500 focus:outline-none"
                                autocomplete="NA" placeholder="Room           Number:">
                            <label for="room_number"
                                class="pointer-events-none absolute top-0 left-0 origin-left -translate-y-1/2 transform text-sm text-gray-800 opacity-75 transition-all duration-100 ease-in-out peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Room
                                Number:</label>
                        </div>
                        <div class="relative mt-6 ">
                            <div class="main flex border rounded-full overflow-hidden m-4 select-none">
                                <div class="title py-3 my-auto px-5 bg-gray-900 text-white text-sm font-semibold mr-3">
                                    T Y P E</div>
                                <label for="theory" class="flex radio p-2 cursor-pointer">
                                    <input type="radio" id="theory" name="room_type" value="theory" required
                                        class="my-auto transform scale-125">

                                    <div class="title px-2">Theory</div>
                                </label>

                                <label for="lab" class="flex radio p-2 cursor-pointer">
                                    <input type="radio" id="lab" name="room_type" value="lab" required
                                        class="my-auto transform scale-125">
                                    <div class="title px-2">Lab</div>
                                </label>

                            </div>
                        </div>
                        <div class=" my-6">
                            <input type="submit" value="Add Room"
                                class="w-full rounded-md bg-gray-900 px-3 py-4 text-white focus:bg-gray-400 focus:outline-none">
                        </div>
                    </form>
                    <p class="text-center text-sm text-gray-500">
                        View All Room <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                        <a class="underline" href="../room/room.php">Here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$conn->close();
?>
</div>
<script src="../../include/index.js"></script>


</body>

</html>