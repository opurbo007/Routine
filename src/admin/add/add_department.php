<!DOCTYPE html>
<html>
<head>
    <title>Add Department</title>
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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $department_name = $_POST["department_name"];

        // Insert the new department into the Department table
        $sql_insert_department = "INSERT INTO Department (department_name) VALUES ('$department_name')";

        if ($conn->query($sql_insert_department) === TRUE) {
            echo "<p>New department added successfully!</p>";
        } else {
            echo "<p>Error adding department: " . $conn->error . "</p>";
        }
    }
    ?>

    <h2>Add Department</h2>
    <form method="post">
        <label for="department_name">Department Name:</label>
        <input type="text" id="department_name" name="department_name" required>
        <input type="submit" value="Add Department">
    </form>

    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
