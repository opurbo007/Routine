<!DOCTYPE html>
<html>

<head>
  <title>Batch Information</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">
  <div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4">Batch Information</h2>

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

    // Handle delete action
    if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["batch_id"])) {
      $batch_id = $_GET["batch_id"];
      $sql_delete_batch = "DELETE FROM Batch WHERE batch_id = $batch_id";

      if ($conn->query($sql_delete_batch) === TRUE) {
        echo "<p class='text-green-500'>Batch deleted successfully!</p>";
      } else {
        echo "<p class='text-red-500'>Error deleting batch: " . $conn->error . "</p>";
      }
    }

    // Fetch batch information
    $sql_batches = "SELECT * FROM Batch";
    $result_batches = $conn->query($sql_batches);
    ?>

    <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
      <thead class="bg-gray-200">
        <tr>
          <th class="px-4 py-2">#</th>
          <th class="px-4 py-2">Batch Number</th>
          <th class="px-4 py-2">Department</th>
          <th class="px-4 py-2">Shift</th>
          <th class="px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result_batches->num_rows > 0) {
          $count = 1;
          while ($row = $result_batches->fetch_assoc()) {
            $batch_id = $row['batch_id'];
            $batch_number = $row['batch_number'];
            $department_id = $row['department_id'];
            $batch_shift = $row['batch_shift'];

            // Fetch department name
            $sql_department = "SELECT department_name FROM Department WHERE department_id = $department_id";
            $result_department = $conn->query($sql_department);
            $department_name = $result_department->fetch_assoc()['department_name'];
            ?>

            <tr>
              <td class="border px-4 py-2">
                <?php echo $count; ?>
              </td>
              <td class="border px-4 py-2">
                <?php echo $batch_number; ?>
              </td>
              <td class="border px-4 py-2">
                <?php echo $department_name; ?>
              </td>
              <td class="border px-4 py-2">
                <?php echo $batch_shift; ?>
              </td>
              <td class="border px-4 py-2">
                <a href="edit_batch.php?batch_id=<?php echo $batch_id; ?>"
                  class="text-blue-500 hover:underline mr-2">Edit</a>
                <a href="?action=delete&batch_id=<?php echo $batch_id; ?>" class="text-red-500 hover:underline"
                  onclick="return confirm('Are you sure you want to delete this batch?')">Delete</a>
              </td>
            </tr>

            <?php
            $count++;
          }
        } else {
          echo "<tr><td colspan='5' class='border px-4 py-2 text-center'>No batches found.</td></tr>";
        }
        ?>
      </tbody>
    </table>

    <?php
    // Close the database connection
    $conn->close();
    ?>
  </div>
</body>

</html>