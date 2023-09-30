<?php
// Replace with your database connection code
include("../../../../database/config.php");

if (isset($_POST['department_id'])) {
    $departmentId = $_POST['department_id'];

    // Query to retrieve teachers in the selected department
    $teacher_query = "SELECT `teacher_id`, `name` FROM `teachers` WHERE `department_id` = $departmentId";
    $teacher_result = $conn->query($teacher_query);

    $teachers = array();
    if ($teacher_result->num_rows > 0) {
        while ($teacher_row = $teacher_result->fetch_assoc()) {
            $teachers[] = $teacher_row;
        }
    }

    // Return the teachers as JSON
    header('Content-Type: application/json');
    echo json_encode($teachers);
}

$conn->close();
?>
