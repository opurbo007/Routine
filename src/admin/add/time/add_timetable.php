<?php
include("../../../include/auth.php");
include("../../../../database/config.php");
include("../../../include/adminNavbar.php");
?>
<div class="flex flex-col min-h-screen w-full">

    <?php

    // error or succes msg 
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
    ?>


    <div class="flex items-center justify-center flex-grow-2">

        <div
            class="relative mx-auto w-full max-w-md bg-white px-6 pt-10 mt-24 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:rounded-xl sm:px-10">
            <div class="w-full">
                <div class="text-center">
                    <h1 class="text-2xl font-semibold text-gray-900">Add Department</h1>
                </div>
                <div class="mt-5">
                    <form method="post" action="insert.php" id="addTimetableForm">

                        <div class="relative mt-6">
                            <div class="flex items-center mb-4">
                                <label for="start_hour" class="mr-2">Start Time</label>
                                <input type="number" id="start_hour" name="start_hour" min="0" max="23" required
                                    class="w-1/3 px-2 py-1 text-gray-700 border rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-300 focus:outline-none">
                                <span class="mx-1">:</span>
                                <input type="number" id="start_minute" name="start_minute" min="0" max="59" required
                                    class="w-1/3 px-2 py-1 text-gray-700 border rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-300 focus:outline-none">
                            </div>

                            <div class="flex items-center">
                                <label for="end_hour" class="mr-3.5">End Time</label>
                                <input type="number" id="end_hour" name="end_hour" min="0" max="23" required
                                    class="w-1/3 px-2 py-1 text-gray-700 border rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-300 focus:outline-none">
                                <span class="mx-1">:</span>
                                <input type="number" id="end_minute" name="end_minute" min="0" max="59" required
                                    class="w-1/3 px-2 py-1 text-gray-700 border rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-300 focus:outline-none">
                            </div>
                        </div>
                        <div class="relative mt-6">

                            <select id="class_type" name="class_type" required
                                class="w-full text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-gray-300">
                                <option value="" disabled selected>Select a class type</option>
                                <option value="theory">Theory</option>
                                <option value="lab">Lab</option>
                            </select>
                        </div>
                        <div class=" my-6">
                            <input type="submit" value="Add Timetable Entry"
                                class="w-full rounded-md bg-gray-900 px-3 py-2 text-white focus:bg-gray-400 focus:outline-none">
                        </div>
                    </form>
                    <p class="text-center text-sm text-gray-500">
                        View All Room <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                        <a class="underline" href="../../time/timetable.php">Here</a>
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
<script src="../../../include/index.js"></script>


</body>

</html>