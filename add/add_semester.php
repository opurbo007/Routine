<!DOCTYPE html>
<html>
<head>
    <title>Add Semester</title>
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
    $sql_departments = "SELECT * FROM Department";
    $result_departments = $conn->query($sql_departments);

    // Handle the form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $semester_name = $_POST["semester_name"];
        $department_id = $_POST["department_id"];

        // Insert the new semester into the Semester table
        $sql_insert_semester = "INSERT INTO Semester (semester_name, department_id) VALUES ('$semester_name', $department_id)";

        if ($conn->query($sql_insert_semester) === TRUE) {
            echo "<p>New semester added successfully!</p>";
        } else {
            echo "<p>Error adding semester: " . $conn->error . "</p>";
        }
    }
    ?>

    <h2>Add Semester</h2>
    <form method="post">
        <label for="semester_name">Semester Name:</label>
        <input type="text" id="semester_name" name="semester_name" required>

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
        </select>

        <input type="submit" value="Add Semester">
    </form>

    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
