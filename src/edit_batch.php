<!DOCTYPE html>
<html>

<head>
    <title>Edit Batch</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h2 class="text-2xl font-bold mb-4">Edit Batch</h2>

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
            $batch_id = $_POST["batch_id"];
            $batch_number = $_POST["batch_number"];
            $department_id = $_POST["department_id"];
            $batch_shift = $_POST["batch_shift"];

            // Update the batch information
            $sql_update_batch = "UPDATE Batch SET batch_number = '$batch_number', department_id = $department_id, batch_shift = '$batch_shift' WHERE batch_id = $batch_id";

            if ($conn->query($sql_update_batch) === TRUE) {
                echo "<p class='text-green-500'>Batch updated successfully!</p>";
            } else {
                echo "<p class='text-red-500'>Error updating batch: " . $conn->error . "</p>";
            }
        }

        // Fetch batch information based on batch_id parameter
        if (isset($_GET["batch_id"])) {
            $batch_id = $_GET["batch_id"];
            $sql_fetch_batch = "SELECT * FROM Batch WHERE batch_id = $batch_id";
            $result_fetch_batch = $conn->query($sql_fetch_batch);
            $batch_data = $result_fetch_batch->fetch_assoc();
        }

        // Fetch department information
        $sql_departments = "SELECT * FROM Department";
        $result_departments = $conn->query($sql_departments);
        ?>

        <form method="post">
            <input type="hidden" name="batch_id" value="<?php echo $batch_id; ?>">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Batch Number</label>
                <input type="text" name="batch_number" value="<?php echo $batch_data['batch_number']; ?>"
                       class="mt-1 p-2 block w-full rounded-md bg-gray-100 border border-gray-300">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Select Department</label>
                <select name="department_id" class="mt-1 p-2 block w-full rounded-md bg-gray-100 border border-gray-300">
                    <?php
                    if ($result_departments->num_rows > 0) {
                        while ($row = $result_departments->fetch_assoc()) {
                            $department_id = $row['department_id'];
                            $department_name = $row['department_name'];
                            $selected = ($department_id == $batch_data['department_id']) ? 'selected' : '';
                            echo "<option value='$department_id' $selected>$department_name</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Batch Shift</label>
                <input type="radio" id="day" name="batch_shift" value="day"
                       <?php if ($batch_data['batch_shift'] == 'day') echo 'checked'; ?>>
                <label for="day">Day</label>
                <input type="radio" id="evening" name="batch_shift" value="evening"
                       <?php if ($batch_data['batch_shift'] == 'evening') echo 'checked'; ?>>
                <label for="evening">Evening</label>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Update Batch
            </button>
        </form>

        <?php
        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>

</html>
