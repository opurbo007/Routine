<?php
include("../../../include/auth.php");
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


    ?>

    <div class="flex items-center justify-center flex-grow-2">

        <div
            class="relative mx-auto w-full max-w-md bg-white px-6 pt-10 mt-24 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:rounded-xl sm:px-10">
            <div class="w-full">
                <div class="text-center">
                    <h1 class="text-2xl font-semibold text-gray-900">Add Department</h1>
                </div>
                <div class="mt-5">
                    <form method="post" action="insert.php">
                        <div class="relative mt-6">
                            <input type="text" id="department_name" name="department_name" required
                                class="peer mt-1 w-full border-b-2 border-gray-300 px-0 py-1 placeholder:text-transparent focus:border-gray-500 focus:outline-none"
                                autocomplete="NA" placeholder="Department Name">
                            <label for="department_name"
                                class="pointer-events-none absolute top-0 left-0 origin-left -translate-y-1/2 transform text-sm text-gray-800 opacity-75 transition-all duration-100 ease-in-out peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Department
                                Name:</label>

                        </div>
                        <div class="my-6">
                            <input type="submit" value="Add Department"
                                class="w-full rounded-md bg-gray-900 px-3 py-2 text-white focus:bg-gray-400 focus:outline-none">
                        </div>
                    </form>

                    <p class="text-center text-sm text-gray-500">
                        View All Department <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                        <a class="underline" href="../../view/dept/dept.php">Here</a>
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