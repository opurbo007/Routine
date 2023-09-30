<?php
session_start();
include("../../../../database/config.php");
include("../../../include/adminNavbar.php");
?>
<style>
.nav-container {
  flex: 0 0 99px;
}
</style>
<div class="flex flex-col min-h-screen w-full">


  <div class="flex justify-between my-4">
    <!-- Search Form -->
    <form method="POST" action="" class="flex items-center space-x-4">
      <div class="flex items-center space-x-4">
        <!-- <label for="course_name">Course Name:</label> -->
        <input type="text" id="course_name" name="course_name"
          class="text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5"
          placeholder="Course Name">
      </div>

      <div class="flex items-center space-x-4">
        <!-- <label for="day">Day:</label> -->
        <select id="day" name="day"
          class="text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
          <option value="">Select Day</option>
          <option value="Monday">Monday</option>
          <option value="Tuesday">Tuesday</option>
          <option value="Wednesday">Wednesday</option>
          <option value="Thursday">Thursday</option>
          <option value="Friday">Friday</option>
          <option value="Saturday">Saturday</option>
          <option value="Sunday">Sunday</option>
        </select>
      </div>

      <div class="flex items-center space-x-4">
        <!-- <label for="batch">Batch:</label> -->
        <select id="batch" name="batch"
          class="text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
          <option value="">Select Batch</option>
          <?php


                // Query to retrieve batch numbers and IDs
                $batch_query = "SELECT `batch_id`, `batch_number` FROM `batch`";
                $batch_result = $conn->query($batch_query);

                if ($batch_result->num_rows > 0) {
                    while ($batch_row = $batch_result->fetch_assoc()) {
                        echo "<option value='" . $batch_row['batch_id'] . "'>" . $batch_row['batch_number'] . "</option>";
                    }
                }
                ?>
        </select>
      </div>

      <div class="flex items-center space-x-4">
        <!-- <label for="department_id">Department:</label> -->
        <select id="department_id" name="department_id"
          class="text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
          <option value="">Select Department</option>
          <?php
                // Include the database connection code here
                $department_query = "SELECT `department_id`, `department_name` FROM `department`";
                $department_result = $conn->query($department_query);

                if ($department_result->num_rows > 0) {
                    while ($department_row = $department_result->fetch_assoc()) {
                        echo "<option value='" . $department_row['department_id'] . "'>" . $department_row['department_name'] . "</option>";
                    }
                }
                ?>
        </select>
      </div>

      <div class="flex items-center space-x-4" id="teacherDropdown">
        <!-- <label for="teacher_id">Teacher Name:</label> -->
        <select id="teacher_id" name="teacher_id"
          class="text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
          <option value="">Select Teacher</option>
        </select>
      </div>

      <button type="submit" value="Search" class="ml-2 bg-gray-900 hover:bg-gray-600 text-white py-2 px-4 rounded"><i
          class="fa fa-search" aria-hidden="true"></i></button>
    </form>
  </div>

  <div class="flex flex-col min-h-screen w-full">
    <div class="flex justify-between mt-4">
      <div>
        <p class="border border-black flex">
          <a href="select.php"
            class="inline-block px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-600 hover:no-underline">
            Make Routine
          </a>
        </p>
      </div>
    </div>
    <div class="container mx-auto py-8">
      <table class="table-auto w-full bg-white">
        <thead>
          <tr>
            <th class="px-4 py-2 border">Routine ID</th>
            <th class="px-4 py-2 border">Batch Number</th>
            <th class="px-4 py-2 border">Semester Name</th>

            <th class="px-4 py-2 border">Session</th>
            <th class="px-4 py-2 border">Course Name</th>
            <th class="px-4 py-2 border">Teacher Name</th>
            <th class="px-4 py-2 border">Day</th>
            <th class="px-10 py-2 border">Time</th>

            <th class="px-4 py-2 border">Room Number</th>


          </tr>
        </thead>
        <tbody>
          <?php




$where = "";


// Retrieve search criteria from the form
$course_name = isset($_POST["course_name"]) ? $_POST["course_name"] : "";
$day = isset($_POST["day"]) ? $_POST["day"] : "";
$teacher_id = isset($_POST["teacher_id"]) ? $_POST["teacher_id"] : "";
$department_id = isset($_POST["department_id"]) ? $_POST["department_id"] : "";
$batch_id = isset($_POST["batch"]) ? $_POST["batch"] : ""; // Note the change in the variable name

// Build the WHERE clause based on the provided criteria
if (!empty($course_name)) {
    $where .= " AND c.`course_name` LIKE '%$course_name%'";
}
if (!empty($day)) {
    $where .= " AND r.`day` LIKE '%$day%'";
}
if (!empty($teacher_id)) {
    $where .= " AND r.`teacher_id` = $teacher_id";
}
if (!empty($department_id)) {
    $where .= " AND t.`department_id` = $department_id";
}
if (!empty($batch_id)) { // No need to change this line
    $where .= " AND ba.`batch_id` = $batch_id";
}


        $sql = "SELECT r.`routine_id`, c.`course_name`, r.`day`, r.`start_time`, 
        ro.`room_number`, t.`name` AS 'name', ba.`batch_number`, 
        se.`semester_name`, r.`end_time`, r.`session`, 
        tea.`mobile`, tea.`department_id`, tea.`position`, tea.`mail`, tea.`picture`
        FROM `routine` r
        JOIN `course` c ON r.`course_id` = c.`course_id`
        JOIN `teachers` t ON r.`teacher_id` = t.`teacher_id`
        JOIN `room` ro ON r.`room_id` = ro.`room_id`
        JOIN `batch` ba ON r.`batch` = ba.`batch_id`
        JOIN `semester` se ON r.`semester` = se.`semester_id`
        JOIN `teachers` tea ON r.`teacher_id` = tea.`teacher_id`
        WHERE 1 $where"; 


        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {?>
          <tr>
            <td class="border px-4 py-2"><?php echo $row['routine_id'] ?> </td>
            <td class="border px-4 py-2"><?php echo $row['batch_number'] ?> </td>
            <td class="border px-4 py-2"><?php echo $row['semester_name'] ?> </td>

            <td class="border px-4 py-2"><?php echo $row['session'] ?> </td>
            <td class="border px-4 py-2"><?php echo $row['course_name'] ?> </td>
            <td class="border px-4 py-2"><?php echo $row['name'] ?> </td>
            <td class="border px-4 py-2"><?php echo $row['day'] ?> </td>
            <td class="border px-3 py-2">
              <?php
    $start_time = strtotime($row['start_time']);
    $end_time = strtotime($row['end_time']);
    
    $formatted_start_time = date('H:i', $start_time);
    $formatted_end_time = date('H:i', $end_time);

    echo $formatted_start_time . '-' . $formatted_end_time;
    ?>
            </td>


            <td class="border px-4 py-2"><?php echo $row['room_number'] ?> </td>


          </tr>
          <?php }
        } else {
            echo "<tr><td colspan='3' class='text-center'>No Routine found.</td></tr>";

        }



        ?>
        </tbody>
      </table>
    </div>
    <?php
  $conn->close();
  ?>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Get references to the department and teacher dropdowns
  const departmentDropdown = document.getElementById('department_id');
  const teacherDropdown = document.getElementById('teacher_id');

  // Define a function to update the teacher dropdown based on the selected department
  function updateTeacherDropdown() {
    const selectedDepartmentId = departmentDropdown.value;

    // Clear the teacher dropdown
    teacherDropdown.innerHTML = '';

    // If a department is selected, fetch and populate teachers from that department
    if (selectedDepartmentId) {
      // Replace with your database connection code
      const formData = new FormData();
      formData.append('department_id', selectedDepartmentId);

      fetch('fetch_teachers.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.length > 0) {
            teacherDropdown.innerHTML = '<option value="">Select Teacher</option>';
            data.forEach(teacher => {
              teacherDropdown.innerHTML += `<option value="${teacher.teacher_id}">${teacher.name}</option>`;
            });
          } else {
            teacherDropdown.innerHTML = '<option value="">No Teachers Available</option>';
          }
        })
        .catch(error => {
          console.error('Error fetching teachers:', error);
        });
    } else {
      // If no department is selected, show all teachers
      teacherDropdown.innerHTML = '<option value="">Select Teacher</option>';
    }
  }


  departmentDropdown.addEventListener('change', updateTeacherDropdown);

  updateTeacherDropdown();
});
</script>

<script src="../../../include/index.js"></script>
</body>



</html>