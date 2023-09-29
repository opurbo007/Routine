<?php
include("../../../database/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["department_id"])) {
    $department_id = $_POST["department_id"];

    // Fetch semesters for the selected department
    $sql_semesters = "SELECT * FROM Semester WHERE department_id = $department_id";
    $result_semesters = $conn->query($sql_semesters);

    $semesters = array();
    if ($result_semesters->num_rows > 0) {
        while ($row = $result_semesters->fetch_assoc()) {
            $semesters[] = $row;
        }
    }

    echo json_encode($semesters);
}


$conn->close();
?>
