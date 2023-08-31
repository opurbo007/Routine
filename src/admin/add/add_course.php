<?php
include("../../../database/config.php");
include("../../include/adminNavbar.php");

?>

<div class="flex flex-col min-h-screen w-full">

    <?php
    // Fetch departments for dropdown
    $sql_departments = "SELECT * FROM department";
    $result_departments = $conn->query($sql_departments);
    ?>

    <h2>Add Course</h2>
    <form method="post" id="addCourseForm">
        <label for="course_code">Course Code:</label>
        <input type="text" id="course_code" name="course_code" required><br><br>

        <label for="course_name">Course Name:</label>
        <input type="text" id="course_name" name="course_name" required><br><br>

        <label for="department_id">Select Department:</label>
        <select id="department_id" name="department_id" required>
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
        </select><br><br>

        <label for="semester_id">Select Semester:</label>
        <select id="semester_id" name="semester_id" required>
            <option value="" disabled selected>Select a department first</option>
        </select><br><br>

        <label for="credits">Credits:</label>
        <input type="number" id="credits" name="credits" step="0.1" required><br><br>

        <label>Course Type:</label>
        <input type="radio" id="theory" name="course_type" value="theory" required>
        <label for="theory">Theory</label>
        <input type="radio" id="lab" name="course_type" value="lab" required>
        <label for="lab">Lab</label><br><br>

        <input type="submit" value="Add Course">
    </form>


    <script>
        // Update semester dropdown when department is selected
        $('#department_id').on('change', function () {
            var departmentId = $(this).val();
            if (departmentId) {
                $.ajax({
                    url: 'get_semesters.php',
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


    // Close the database connection
    $conn->close();
    ?>
    </body>

    </html>