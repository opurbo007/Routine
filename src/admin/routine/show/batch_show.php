<?php
include("../../../include/auth.php");
include("../../../../database/config.php");
include("../../../include/adminNavbar.php");

// Fetch batch data including semester, session, and routine information
$batchQuery = "SELECT batch.batch_id, batch.batch_number, semester.semester_name, routine.session, COUNT(routine.routine_id) AS routine_count
               FROM batch
               LEFT JOIN routine ON batch.batch_id = routine.batch
               LEFT JOIN semester ON routine.semester = semester.semester_id
               GROUP BY batch.batch_id, batch.batch_number, semester.semester_name, routine.session";
$batchResult = $conn->query($batchQuery);

?>

<div class="flex flex-col min-h-screen w-full">
  <div class="flex justify-between mt-4">
    <div>
      <p class="border border-black flex">
        <a href="select.php"
          class="inline-block px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-600 hover:no-underline">
          Back
        </a>
      </p>
    </div>
  </div>
  <div class="container mx-auto py-8">
    <table class="table-auto w-full">
      <thead>
        <tr>
          <th class="px-4 border py-2">Batch</th>
          <th class="px-4 border py-2">Semester</th>
          <th class="px-4 border py-2">Session</th>
          <th class="px-4 border py-2">Routine Made</th>
          <th class="px-4 border py-2">Actions</th> <!-- New column for actions -->
        </tr>
      </thead>
      <tbody>
        <?php
        while ($row = $batchResult->fetch_assoc()) {
          $batchId = $row['batch_id'];
          $batchName = $row['batch_number'];
          $semesterName = $row['semester_name'];
          $session = $row['session'];
          $routineCount = $row['routine_count'];

          // Determine the symbol to display based on the routine count
          $symbol = ($routineCount > 0) ? '✔' : '✘';

          echo "<tr>";
          echo "<td class='border px-4 py-4'>$batchName</td>";
          echo "<td class='border px-4 py-4'>$semesterName</td>";
          echo "<td class='border px-4 py-4'>$session</td>";
          echo "<td class='border px-4 py-4'>$symbol</td>";
          echo "<td class='border px-4 py-4'>";
          if ($routineCount > 0) {
            // Display a delete button only if routines exist
            echo "<button onclick=\"deleteRoutine($batchId, '$semesterName', '$session')\" class='bg-red-500 text-white px-2 py-1 rounded hover:bg-red-700'>Delete</button>";
          } else {
            echo "N/A"; // No routines to delete
          }
          echo "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
  <?php
  $conn->close();
  ?>


  <script>

    function deleteRoutine(batchId, semesterName, session) {
      if (confirm(`Are you sure you want to delete all routines for Batch ${batchId}, Semester ${semesterName}, Session ${session}?`)) {

        window.location.href = `delete_full_routine.php?batchId=${batchId}&semesterName=${semesterName}&session=${session}`;
      }
    }
  </script>

</div>
<script src="../../../include/index.js"></script>
</body>

</html>