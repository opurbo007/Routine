<!DOCTYPE html>
<html>

<head>
    <title>Add Teacher</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <?php
    // Replace these variables with your database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "routine";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch departments for dropdown
    $sql_departments = "SELECT * FROM department";
    $result_departments = $conn->query($sql_departments);

    ?>

    <h2>Add Teacher</h2>
    <form method="post" id="addTeacherForm" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="mobile">Mobile Number:</label>
        <input type="text" id="mobile" name="mobile" required><br><br>

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

        <label for="position">Position:</label>
        <select id="position" name="position" required>
            <option value="" disabled selected>Select a position</option>
            <option value="Professor">Professor</option>
            <option value="Associate Professor">Associate Professor</option>
            <option value="Assistant Professor">Assistant Professor</option>
            <option value="Lecturer">Lecturer</option>
        </select><br><br>

        <label for="mail">Mail:</label>
        <input type="email" id="mail" name="mail" required><br><br>

        <label for="picture">Picture:</label>
        <input type="file" id="picture" name="picture"><br><br>

        <label for="selectCourse">Show All Subjects:</label>
        <?php
        // Fetch departments for toggle buttons
        $sql_departments = "SELECT * FROM department";
        $result_departments = $conn->query($sql_departments);

        if ($result_departments->num_rows > 0) {
            while ($row = $result_departments->fetch_assoc()) {
                $department_id = $row['department_id'];
                $department_name = $row['department_name'];
                echo "<button type='button' class='department-toggle' data-department='$department_id'>$department_name</button>";
            }
        }
        ?>
        <br><br>
        <div id="course-list" style="display: none;">
            <h3>Available Courses</h3>
            <div id="course-container">
                <!-- Course list will be displayed here -->
            </div>
        </div>

        <input type="submit" value="Add Teacher">
    </form>
    <script>
        $(document).ready(function () {
            $('.department-toggle').click(function () {
                var departmentId = $(this).data('department');

                // Toggle the course list visibility
                $('#course-list').toggle();

                // Fetch and display courses for the selected department
                $.ajax({
                    url: 'get_course_by_dept.php',
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

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $mobile = $_POST["mobile"];
        $department_id = $_POST["department_id"];
        $position = $_POST["position"];
        $mail = $_POST["mail"];
        $courses = $_POST["courses"];

        // Check if the teacher with the given mobile number already exists
        $sql_check_teacher = "SELECT * FROM Teachers WHERE mobile = '$mobile'";
        $result_check_teacher = $conn->query($sql_check_teacher);

        if ($result_check_teacher->num_rows > 0) {
            echo "<p>Teacher with the given mobile number already exists!</p>";
        } else {
            $sql_insert_teacher = "INSERT INTO Teachers (name, mobile, department_id, position, mail) VALUES ('$name', '$mobile', $department_id, '$position', '$mail')";

            if ($conn->query($sql_insert_teacher) === TRUE) {
                $teacher_id = $conn->insert_id;

                // Insert selected courses into TeacherCourses table
                foreach ($courses as $course_code) {
                    $sql_insert_teacher_courses = "INSERT INTO TeacherCourses (teacher_id, course_id) SELECT $teacher_id, course_id FROM Course WHERE course_code = '$course_code'";
                    $conn->query($sql_insert_teacher_courses);
                }

                echo "<p>New teacher added successfully!</p>";
            } else {
                echo "<p>Error adding teacher: " . $conn->error . "</p>";
            }
        }
    }

    // Close the database connection
    $conn->close();
    ?>
</body>

</html>