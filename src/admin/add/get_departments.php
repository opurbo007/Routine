<?php
include("../../../database/config.php");

// Fetch departments
$sql_departments = "SELECT * FROM Department";
$result_departments = $conn->query($sql_departments);

// Prepare data in array
$departments = array();
if ($result_departments->num_rows > 0) {
    while ($row = $result_departments->fetch_assoc()) {
        $departments[] = array(
            'department_id' => $row['department_id'],
            'department_name' => $row['department_name']
        );
    }
}

$conn->close();

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($departments);
?>
