<!DOCTYPE html>
<html>

<head>
    <title>Add Timetable Entry</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <h2>Add Timetable Entry</h2>
    <form method="post" id="addTimetableForm">
        <label for="start_hour">Start Time:</label>
        <input type="number" id="start_hour" name="start_hour" min="0" max="23" required> :
        <input type="number" id="start_minute" name="start_minute" min="0" max="59" required>

        <label for="end_hour">End Time:</label>
        <input type="number" id="end_hour" name="end_hour" min="0" max="23" required> :
        <input type="number" id="end_minute" name="end_minute" min="0" max="59" required>

        <label for="class_type">Class Type:</label>
        <select id="class_type" name="class_type" required>
            <option value="" disabled selected>Select a class type</option>
            <option value="theory">Theory</option>
            <option value="lab">Lab</option>
        </select>

        <input type="submit" value="Add Timetable Entry">
    </form>

    <script>
        $('#addTimetableForm').submit(function (event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.post('add_timetable.php', formData, function (response) {
                $('#addTimetableForm')[0].reset();
                alert(response);
            });
        });
    </script>
</body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "routine";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_time = $_POST["start_hour"] . ":" . $_POST["start_minute"] . ":00";
    $end_time = $_POST["end_hour"] . ":" . $_POST["end_minute"] . ":00";
    $class_type = $_POST["class_type"];

    $sql_insert_timetable = "INSERT INTO timeslot (start_time, end_time, class_type) VALUES ('$start_time', '$end_time', '$class_type')";

    $response = $conn->query($sql_insert_timetable) ? "Timetable entry added successfully!" : "Error adding timetable entry: " . $conn->error;
    echo $response;

    $conn->close();
}
?>