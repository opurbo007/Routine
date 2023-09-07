<?php

session_start();
ob_start();

include("../../../../database/config.php");
include("../../../include/adminNavbar.php");


?>
<div class="flex flex-col min-h-screen w-full">

  <?php
  $course_id = $_GET['course_id'];

  if (isset($_POST['submit'])) {
    $new_course_code = $_POST['course_code'];
    $new_course_name = $_POST['course_name'];
    $new_credits = $_POST['credits'];
    $new_department_id = $_POST['department_id'];
    $new_semester_id = $_POST['semester_id'];

    // Update course details in the database
    $sql_update_course = "UPDATE Course SET course_code = '$new_course_code', course_name = '$new_course_name', credits = '$new_credits', department_id = '$new_department_id', semester_id = '$new_semester_id' WHERE course_id = '$course_id'";

    if ($conn->query($sql_update_course) === TRUE) {
      $_SESSION['success_message'] = "Successfully Course Updated";
    } else {

      $_SESSION['error_message'] = "Error! Course Not updated";
    }
    header('Location: course.php');
    exit;
  }

  // Retrieve course details from the database
  $sql_course = "SELECT * FROM Course WHERE course_id = '$course_id'";
  $result_course = $conn->query($sql_course);
  $course = $result_course->fetch_assoc();

  // Fetch departments for dropdown
  $sql_departments = "SELECT * FROM department";
  $result_departments = $conn->query($sql_departments);

  // Fetch semesters for dropdown
  $sql_semesters = "SELECT * FROM Semester";
  $result_semesters = $conn->query($sql_semesters);

  ?>

  <div class="flex items-center justify-center flex-grow-2">

    <div
      class="relative mx-auto w-full max-w-md bg-white px-6 pt-10 mt-24 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:rounded-xl sm:px-10">
      <div class="w-full">
        <div class="text-center">
          <h1 class="text-2xl font-semibold text-gray-900">Update Course</h1>
        </div>
        <div class="mt-5">
          <form method="post">
            <div class="relative mt-6">
              <label for="course_code" class="block text-sm font-medium text-gray-700">Course Code:</label>
              <input type="text" id="course_code" name="course_code" value="<?php echo $course['course_code']; ?>"
                required class="mt-1 p-2 block w-full rounded-md bg-gray-100 border border-gray-300">
            </div>
            <div class="relative mt-6">
              <label for="course_name" class="block text-sm font-medium text-gray-700">Course Name:</label>
              <input type="text" id="course_name" name="course_name" value="<?php echo $course['course_name']; ?>"
                required class="mt-1 p-2 block w-full rounded-md bg-gray-100 border border-gray-300">
            </div>
            <div class="relative mt-6">
              <label for="credits" class="block text-sm font-medium text-gray-700">Credits:</label>
              <input type="number" id="credits" name="credits" value="<?php echo $course['credits']; ?>" required
                class="mt-1 p-2 block w-full rounded-md bg-gray-100 border border-gray-300">
            </div>
            <div class="relative mt-6">
              <!-- <label for="department_id">Select Department:</label> -->
              <select id="department_id" name="department_id" required
                class="w-full text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-gray-300">
                <?php
                if ($result_departments->num_rows > 0) {
                  while ($row = $result_departments->fetch_assoc()) {
                    $department_id = $row['department_id'];
                    $department_name = $row['department_name'];
                    $selected = ($department_id == $course['department_id']) ? 'selected' : '';
                    echo "<option value='$department_id' $selected>$department_name</option>";
                  }
                }
                ?>
              </select>
            </div>
            <div class="relative mt-6">
              <!-- <label for="semester_id">Select Semester:</label> -->
              <select id="semester_id" name="semester_id" required
                class="w-full text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-gray-300">
                <?php
                if ($result_semesters->num_rows > 0) {
                  while ($row = $result_semesters->fetch_assoc()) {
                    $semester_id = $row['semester_id'];
                    $semester_name = $row['semester_name'];
                    $selected = ($semester_id == $course['semester_id']) ? 'selected' : '';
                    echo "<option value='$semester_id' $selected>$semester_name</option>";
                  }
                }
                ?>
              </select>
            </div>
            <div class=" my-6">
              <input type="submit" name="submit" value="Update Course"
                class="w-full rounded-md bg-gray-900 px-3 py-2 text-white focus:bg-gray-400 focus:outline-none">
            </div>
          </form>
          <p class="text-center text-sm text-gray-500">
            View All Semester <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
            <a class="underline" href="./semester.php">Here</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php


$conn->close();
ob_end_flush();
?>
</div>
<script src="../../../include/index.js"></script>


</body>

</html>