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

// Check if semester_id is provided in the request
if (isset($_GET['semester_id'])) {
    $semester_id = $_GET['semester_id'];

    // Fetch courses for the given semester ID
    $sql_courses = "SELECT * FROM Course WHERE semester_id = $semester_id";
    $result_courses = $conn->query($sql_courses);

    // Prepare the data in an array
    $courses = array();
    if ($result_courses->num_rows > 0) {
        while ($row = $result_courses->fetch_assoc()) {
            $courses[] = array(
                'course_id' => $row['course_id'],
                'course_name' => $row['course_name'],
                'credits' => $row['credits']
            );
        }
    }

    // Close the database connection
    $conn->close();

    // Return the data as JSON
    header('Content-Type: application/json');
    echo json_encode($courses);
} else {
    // Invalid request
    http_response_code(400);
    echo json_encode(array('error' => 'Invalid request. Please provide the semester_id parameter.'));
    exit;
}
?>
