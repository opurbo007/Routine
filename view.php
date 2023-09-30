<!DOCTYPE html>
<html>
<head>
    <title>Routine Table</title>
</head>
<body>
    <h1>Routine Table</h1>
    
    <!-- Search Form -->
    <form method="POST" action="">
        <label for="course_name">Course Name:</label>
        <input type="text" id="course_name" name="course_name">
        
        <label for="day">Day:</label>
<select id="day" name="day">
    <option value="">Select Day</option>
    <option value="Monday">Monday</option>
    <option value="Tuesday">Tuesday</option>
    <option value="Wednesday">Wednesday</option>
    <option value="Thursday">Thursday</option>
    <option value="Friday">Friday</option>
    <option value="Saturday">Saturday</option>
    <option value="Sunday">Sunday</option>
</select>

<label for="batch">Batch:</label>
<select id="batch" name="batch">
    <option value="">Select Batch</option>
    <?php
    // Replace with your database connection code
    include("database/config.php");

    // Query to retrieve batch numbers and IDs
    $batch_query = "SELECT `batch_id`, `batch_number` FROM `batch`";
    $batch_result = $conn->query($batch_query);

    if ($batch_result->num_rows > 0) {
        while ($batch_row = $batch_result->fetch_assoc()) {
            echo "<option value='" . $batch_row['batch_id'] . "'>" . $batch_row['batch_number'] . "</option>";
        }
    }
    $conn->close();
    ?>
</select>

   

        <label for="department_id">Department:</label>
    <select id="department_id" name="department_id">
        <option value="">Select Department</option>
        <?php

        include("database/config.php");

     
        $department_query = "SELECT `department_id`, `department_name` FROM `department`";
        $department_result = $conn->query($department_query);

        if ($department_result->num_rows > 0) {
            while ($department_row = $department_result->fetch_assoc()) {
                echo "<option value='" . $department_row['department_id'] . "'>" . $department_row['department_name'] . "</option>";
            }
        }
        $conn->close();
        ?>
    </select>
    
    <div id="teacherDropdown">
      <!-- ... (other form fields) -->

<label for="teacher_id">Teacher Name:</label>
<select id="teacher_id" name="teacher_id">
    <option value="">Select Teacher</option>
</select>


    </div>
        
        <input type="submit" value="Search">
    </form>

    <table border="1">
        <tr>
            <th>Routine ID</th>
            <th>Course Name</th>
            <th>Day</th>
            <th>Start Time</th>
            <th>Room Number</th>
            <th>Teacher Name</th>
            <th>Batch Number</th>
            <th>Semester Name</th>
            <th>End Time</th>
            <th>Session</th>
        </tr>
        <?php
        // Replace with your database connection code
        include("database/config.php");

        // Initialize an empty WHERE clause
        $where = "";

      // Retrieve search criteria from the form
$course_name = $_POST["course_name"];
$day = $_POST["day"];
$teacher_id = $_POST["teacher_id"];
$department_id = $_POST["department_id"];
$batch_id = $_POST["batch"]; // Add this line

// Build the WHERE clause based on the provided criteria
if (!empty($course_name)) {
    $where .= " AND c.`course_name` LIKE '%$course_name%'";
}
if (!empty($day)) {
    $where .= " AND r.`day` LIKE '%$day%'";
}
if (!empty($teacher_id)) {
    $where .= " AND r.`teacher_id` = $teacher_id";
}
if (!empty($department_id)) {
    $where .= " AND t.`department_id` = $department_id";
}
if (!empty($batch_id)) { // Add this block
    $where .= " AND ba.`batch_id` = $batch_id";
}


        $sql = "SELECT r.`routine_id`, c.`course_name`, r.`day`, r.`start_time`, 
        ro.`room_number`, t.`name` AS 'name', ba.`batch_number`, 
        se.`semester_name`, r.`end_time`, r.`session`, 
        tea.`mobile`, tea.`department_id`, tea.`position`, tea.`mail`, tea.`picture`
        FROM `routine` r
        JOIN `course` c ON r.`course_id` = c.`course_id`
        JOIN `teachers` t ON r.`teacher_id` = t.`teacher_id`
        JOIN `room` ro ON r.`room_id` = ro.`room_id`
        JOIN `batch` ba ON r.`batch` = ba.`batch_id`
        JOIN `semester` se ON r.`semester` = se.`semester_id`
        JOIN `teachers` tea ON r.`teacher_id` = tea.`teacher_id`
        WHERE 1 $where"; 


        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['routine_id'] . "</td>";
                echo "<td>" . $row['course_name'] . "</td>";
                echo "<td>" . $row['day'] . "</td>";
                echo "<td>" . $row['start_time'] . "</td>";
                echo "<td>" . $row['room_number'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['batch_number'] . "</td>";
                echo "<td>" . $row['semester_name'] . "</td>";
                echo "<td>" . $row['end_time'] . "</td>";
                echo "<td>" . $row['session'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }

        // Close the database connection
        $conn->close();
        ?>
    </table>
</body>
</html>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Get references to the department and teacher dropdowns
    const departmentDropdown = document.getElementById('department_id');
    const teacherDropdown = document.getElementById('teacher_id');

    // Define a function to update the teacher dropdown based on the selected department
    function updateTeacherDropdown() {
        const selectedDepartmentId = departmentDropdown.value;
        
        // Clear the teacher dropdown
        teacherDropdown.innerHTML = '';

        // If a department is selected, fetch and populate teachers from that department
        if (selectedDepartmentId) {
            // Replace with your database connection code
            const formData = new FormData();
            formData.append('department_id', selectedDepartmentId);
            
            fetch('fetch_teachers.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    teacherDropdown.innerHTML = '<option value="">Select Teacher</option>';
                    data.forEach(teacher => {
                        teacherDropdown.innerHTML += `<option value="${teacher.teacher_id}">${teacher.name}</option>`;
                    });
                } else {
                    teacherDropdown.innerHTML = '<option value="">No Teachers Available</option>';
                }
            })
            .catch(error => {
                console.error('Error fetching teachers:', error);
            });
        } else {
            // If no department is selected, show all teachers
            teacherDropdown.innerHTML = '<option value="">Select Teacher</option>';
        }
    }


    departmentDropdown.addEventListener('change', updateTeacherDropdown);

    updateTeacherDropdown();
});
</script>
