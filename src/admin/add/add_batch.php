<!DOCTYPE html>
<html>

<head>
    <title>Add Batch</title>
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
        $batch_number = $_POST["batch_number"];
        $department_id = $_POST["department_id"];
        $batch_shift = $_POST["batch_shift"];

        // Check if the batch already exists
        $sql_check_batch = "SELECT * FROM Batch WHERE batch_number = '$batch_number' AND department_id = $department_id AND batch_shift = '$batch_shift'";
        $result_check_batch = $conn->query($sql_check_batch);

        if ($result_check_batch->num_rows > 0) {
            echo "<p>Error: Batch already exists for the selected department and shift.</p>";
        } else {
            // Insert the new batch into the Batch table
            $sql_insert_batch = "INSERT INTO Batch (batch_number, department_id, batch_shift) VALUES ('$batch_number', $department_id, '$batch_shift')";

            if ($conn->query($sql_insert_batch) === TRUE) {
                echo "<p>New batch added successfully!</p>";
            } else {
                echo "<p>Error adding batch: " . $conn->error . "</p>";
            }
        }
    }

    // Fetch departments for dropdown
    $sql_departments = "SELECT * FROM Department";
    $result_departments = $conn->query($sql_departments);
    ?>

    <h2>Add Batch</h2>
    <form method="post">
        <label for="batch_number">Batch Number:</label>
        <input type="text" id="batch_number" name="batch_number" required>

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

        <label>Batch Shift:</label>
        <input type="radio" id="day" name="batch_shift" value="day" required>
        <label for="day">Day</label>

        <input type="radio" id="evening" name="batch_shift" value="evening" required>
        <label for="evening">Evening</label>

        <input type="submit" value="Add Batch">
    </form>

    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>

</html>