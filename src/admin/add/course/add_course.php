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
    ?>


    <div class="flex items-center justify-center flex-grow-2">

        <div
            class="relative mx-auto w-full max-w-md bg-white px-6 pt-10 mt-24 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:rounded-xl sm:px-10">
            <div class="w-full">
                <div class="text-center">
                    <h1 class="text-2xl font-semibold text-gray-900">Add Department</h1>
                </div>
                <div class="mt-5">
                    <form method="post" action="insert.php" id="addCourseForm">

                        <div class="relative mt-6">

                            <input type="text" id="course_code" name="course_code" required
                                class="peer mt-1 w-full border-b-2 border-gray-300 px-0 py-1 placeholder:text-transparent focus:border-gray-500 focus:outline-none"
                                autocomplete="NA" placeholder="Code Code:">
                            <label for="course_code"
                                class="pointer-events-none absolute top-0 left-0 origin-left -translate-y-1/2 transform text-sm text-gray-800 opacity-75 transition-all duration-100 ease-in-out peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Course
                                Code:</label>
                        </div>

                        <div class="relative mt-6">
                            <input type="text" id="course_name" name="course_name" required
                                class="peer mt-1 w-full border-b-2 border-gray-300 px-0 py-1 placeholder:text-transparent focus:border-gray-500 focus:outline-none"
                                autocomplete="NA" placeholder="Code Code:">
                            <label for="course_name"
                                class="pointer-events-none absolute top-0 left-0 origin-left -translate-y-1/2 transform text-sm text-gray-800 opacity-75 transition-all duration-100 ease-in-out peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Course
                                Name:</label>
                        </div>
                        <div class="relative mt-6">
                            <!-- <label for="department_id">Select Department:</label> -->
                            <select id="department_id" name="department_id" required
                                class="w-full text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-gray-300">
                                <option value="" disabled selected>Select a Department</option>
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
                            <!-- <label for="semester_id">Select Semester:</label> -->
                            <select id="semester_id" name="semester_id" required
                                class="w-full text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-gray-300">
                                <option value="" disabled selected>Select a Department Before Semester</option>
                            </select>
                        </div>

                        <div class="relative mt-6">

                            <input type="number" id="credits" name="credits" step="0.1" required
                                class="peer mt-1 w-full border-b-2 border-gray-300 px-0 py-1 placeholder:text-transparent focus:border-gray-500 focus:outline-none"
                                autocomplete="NA" placeholder="Credit:"> <label for="credits"
                                class="pointer-events-none absolute top-0 left-0 origin-left -translate-y-1/2 transform text-sm text-gray-800 opacity-75 transition-all duration-100 ease-in-out peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Credit:</label>
                        </div>
                        <div class="relative mt-6 ">
                            <div class="main flex border rounded-full overflow-hidden my-4 w-full select-none">
                                <div class="title py-3 my-auto px-5 bg-gray-900 text-white text-sm font-semibold mr-3">
                                    T Y P E</div>
                                <label for="theory" class="flex radio p-2 cursor-pointer">
                                    <input type="radio" id="theory" name="course_type" value="theory" required
                                        class="my-auto transform scale-125">
                                    <div class="title px-2">Theory</div>
                                </label>
                                <label for="lab" class="flex radio p-2 cursor-pointer">
                                    <input type="radio" id="lab" name="course_type" value="lab" required
                                        class="my-auto transform scale-125">
                                    <div class="title px-2">Lab</div>
                                </label>
                            </div>
                        </div>
                        <div class=" my-6">
                            <input type="submit" value="Add Course"
                                class="w-full rounded-md bg-gray-900 px-3 py-2 text-white focus:bg-gray-400 focus:outline-none">
                        </div>
                    </form>
                    <p class="text-center text-sm text-gray-500">
                        View All Room <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                        <a class="underline" href="../../course/course.php">Here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Update semester dropdown when department is selected
    $('#department_id').on('change', function () {
        var departmentId = $(this).val();
        if (departmentId) {
            $.ajax({
                url: '../get_semesters.php',
                method: 'POST',
                data: { department_id: departmentId },
                dataType: 'json',
                success: function (data) {
                    var options = '<option value="" disabled selected>Select a semester</option>';
                    $.each(data, function (key, value) {
                        options += '<option value="' + value.semester_id + '">' + value.semester_name + '</option>';
                    });
                    $('#semester_id').html(options);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    $('#semester_id').html('<option value="" disabled selected>Error fetching semesters</option>');
                }
            });
        } else {
            $('#semester_id').html('<option value="" disabled selected>Select a department first</option>');
        }
    });
</script>

<?php
$conn->close();
?>
</div>
<script src="../../../include/index.js"></script>

</script>
</body>

</html>