<!DOCTYPE html>
<html>
<head>
    <title>Add Room</title>
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

    // Handle the form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["room_number"]) && isset($_POST["room_type"])) {
        $room_number = $_POST["room_number"];
        $room_type = $_POST["room_type"];

        // Insert the new room into the Room table
        $sql_insert_room = "INSERT INTO Room (room_number, room_type) VALUES ('$room_number', '$room_type')";

        if ($conn->query($sql_insert_room) === TRUE) {
            echo "<p>New room added successfully!</p>";
        } else {
            echo "<p>Error adding room: " . $conn->error . "</p>";
        }
    }

    // Close the database connection
    $conn->close();
    ?>

    <h2>Add Room</h2>
    <form method="post">
        <label for="room_number">Room Number:</label>
        <input type="text" id="room_number" name="room_number" required>
        <br><br>
        <input type="radio" id="theory" name="room_type" value="theory" required>
    
        <label for="theory">Theory</label>
        <input type="radio" id="lab" name="room_type" value="lab" required>
        <label for="lab">Lab</label>
    
       
        <br><br>
        <input type="submit" value="Add Room">
    </form>
</body>
</html>
