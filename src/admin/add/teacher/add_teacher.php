<?php
include("../../../include/auth.php");
include("../../../../database/config.php");
include("../../../include/adminNavbar.php");
?>
<div class="flex flex-col min-h-screen w-full">

    <?php


    // Fetch departments for dropdown
    $sql_departments = "SELECT * FROM department";
    $result_departments = $conn->query($sql_departments);

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
    if (isset($_SESSION['error_pic'])) {

        $errorMessage2 = $_SESSION['error_pic'];
        echo '<div class="flex items-center justify-center mt-6">  
             <div id="errorMessage" class="flex w-96 shadow-lg rounded-lg">
                 <div class="bg-red-600 py-4 px-6 rounded-l-lg flex items-center">
                     <i class="fas fa-times text-white"></i>
                 </div>
                <div class="relative px-4 py-6 bg-white rounded-r-lg flex justify-between items-center w-full border border-l-transparent border-gray-200">
                    <div>' . $errorMessage2 . '</div>
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-red-600"></div>
                </div>
            </div>
        </div>';


        unset($_SESSION['error_pic']);
    }
    if (isset($_SESSION['error_pic2'])) {

        $errorMessage3 = $_SESSION['error_pic2'];
        echo '<div class="flex items-center justify-center mt-6">  
             <div id="errorMessage" class="flex w-96 shadow-lg rounded-lg">
                 <div class="bg-red-600 py-4 px-6 rounded-l-lg flex items-center">
                     <i class="fas fa-times text-white"></i>
                 </div>
                <div class="relative px-4 py-6 bg-white rounded-r-lg flex justify-between items-center w-full border border-l-transparent border-gray-200">
                    <div>' . $errorMessage3 . '</div>
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-red-600"></div>
                </div>
            </div>
        </div>';


        unset($_SESSION['error_pic2']);
    }



    ?>
    <div class="flex items-center justify-center flex-grow-2">

        <div
            class="relative mx-auto w-full max-w-md bg-white px-6 pt-10 mt-24 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:rounded-xl sm:px-10">
            <div class="w-full">
                <div class="text-center">
                    <h1 class="text-2xl font-semibold text-gray-900">Add Teacher</h1>
                </div>
                <div class="mt-5">
                    <form method="post" action="insert.php" id="addTeacherForm" enctype="multipart/form-data">
                        <div class="relative mt-6">

                            <input type="text" id="name" name="name" required
                                class="peer mt-1 w-full border-b-2 border-gray-300 px-0 py-1 placeholder:text-transparent focus:border-gray-500 focus:outline-none"
                                autocomplete="NA" placeholder="Room Number:"> <label for="name"
                                class="pointer-events-none absolute top-0 left-0 origin-left -translate-y-1/2 transform text-sm text-gray-800 opacity-75 transition-all duration-100 ease-in-out peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Full
                                Name:</label>
                        </div>
                        <div class="relative mt-6">

                            <input type="text" id="mobile" name="mobile" required
                                class="peer mt-1 w-full border-b-2 border-gray-300 px-0 py-1 placeholder:text-transparent focus:border-gray-500 focus:outline-none"
                                autocomplete="NA" placeholder="Room Number:"> <label for="mobile"
                                class="pointer-events-none absolute top-0 left-0 origin-left -translate-y-1/2 transform text-sm text-gray-800 opacity-75 transition-all duration-100 ease-in-out peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Mobile
                                Number:</label>
                        </div>
                        <div class="relative mt-6">
                            <!-- <label for="department_id">Select Department:</label> -->
                            <select id="department_id" name="department_id" required
                                class="w-full text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-gray-300">
                                <option value="" disabled selected>Select a department</option>
                                <?php
                                if ($result_departments->num_rows > 0) {
                                    while ($row = $result_departments->fetch_assoc()) {
                                        $department_id = $row['department_id'];
                                        $department_name = $row['department_name'];
                                        echo "<option value='$department_id'>$department_name</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="relative mt-6">
                            <!-- <label for="position">Position:</label> -->
                            <select id="position" name="position" required
                                class="w-full text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-gray-300">
                                <option value="" disabled selected>Select a position</option>
                                <option value="Dean">Dean</option>
                                <option value="Professor">Professor</option>
                                <option value="Associate Professor">Associate Professor</option>
                                <option value="Assistant Professor">Assistant Professor</option>
                                <option value="Lecturer">Lecturer</option>
                            </select>
                        </div>
                        <div class="relative mt-6">


                            <input type="email" id="mail" name="mail" required
                                class="peer mt-1 w-full border-b-2 border-gray-300 px-0 py-1 placeholder:text-transparent focus:border-gray-500 focus:outline-none"
                                autocomplete="NA" placeholder="Room Number:"> <label for="mail"
                                class="pointer-events-none absolute top-0 left-0 origin-left -translate-y-1/2 transform text-sm text-gray-800 opacity-75 transition-all duration-100 ease-in-out peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Mail:</label>
                        </div>
                        <div class="relative mt-6">
                            <input type="password" id="password" name="password" required
                                class="peer mt-1 w-full border-b-2 border-gray-300 px-0 py-1 placeholder:text-transparent focus:border-gray-500 focus:outline-none"
                                autocomplete="NA" placeholder="Room Number:">
                            <label for="password"
                                class="pointer-events-none absolute top-0 left-0 origin-left -translate-y-1/2 transform text-sm text-gray-800 opacity-75 transition-all duration-100 ease-in-out peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Password:</label>
                        </div>
                        <div class="relative mt-6">
                            <label for="file_input" class="custom-file-upload text-md font-semibold">
                                Choose Picture:
                            </label>
                            <input type="file" id="picture" name="picture"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                aria-describedby="file_input_help">
                        </div>
                        <div class="relative mt-6">
                            <label for="selectCourse" class="text-md font-semibold">Select Teacher Choice:</label>
                            <div class="flex flex-wrap mt-3 -mx-2">
                                <?php
                                // Fetch departments for toggle buttons
                                $sql_departments = "SELECT * FROM department";
                                $result_departments = $conn->query($sql_departments);

                                if ($result_departments->num_rows > 0) {
                                    while ($row = $result_departments->fetch_assoc()) {
                                        $department_id = $row['department_id'];
                                        $department_name = $row['department_name'];
                                        echo "<button type='button' class='px-3 py-2 bg-transparent border border-blue-500 text-black rounded-md shadow-md hover:bg-blue-100 mx-2 my-1 department-toggle' data-department='$department_id'>$department_name</button>";
                                    }
                                }
                                ?>
                            </div>
                        </div>


                        <div class="relative mt-6">
                            <div id="course-list" style="display: none;">
                                <h3 class="text-md font-semibold my-4">Available Courses:</h3>
                                <div id="course-container">
                                    <!-- Course list will be displayed here -->
                                </div>
                            </div>
                        </div>
                        <div class=" my-6">
                            <input type="submit" value="Add Teacher"
                                class="w-full rounded-md bg-gray-900 px-3 py-2 text-white focus:bg-gray-400 focus:outline-none">
                        </div>
                    </form>

                    <p class="text-center text-sm text-gray-500">
                        View All Room <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                        <a class="underline" href="../../view/teacher/teacher.php">Here</a>
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
<script>
    $(document).ready(function () {
        $('.department-toggle').click(function () {
            var departmentId = $(this).data('department');

            // Toggle the course list visibility
            $('#course-list').toggle();

            // Fetch and display courses for the selected department
            $.ajax({
                url: '../get_course_by_dept.php',
                method: 'GET',
                data: { department_id: departmentId },
                success: function (data) {
                    $('#course-container').html(data);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
</body>

</html>