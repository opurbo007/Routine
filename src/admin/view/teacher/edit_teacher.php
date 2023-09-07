<?php

session_start();
ob_start();

include("../../../../database/config.php");
include("../../../include/adminNavbar.php");


// Fetch department information
$sql_departments = "SELECT * FROM Department";
$result_departments = $conn->query($sql_departments);


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $teacher_id = $_POST["teacher_id"];
  $name = $_POST["name"];
  $mobile = $_POST["mobile"];
  $department_id = $_POST["department_id"];
  $position = $_POST["position"];
  $mail = $_POST["mail"];
  $courses = $_POST["courses"];

  // Check if a new picture is uploaded
  if ($_FILES["picture"]["name"]) {
    $picture = $_FILES["picture"]["name"];
    $picture_tmp = $_FILES["picture"]["tmp_name"];
    $picture_path = "../../add/teacher/uploads/" . $picture;

    // Move the uploaded picture to the uploads directory
    move_uploaded_file($picture_tmp, $picture_path);

    // Remove the prefix from the picture path
    $picture_path_without_prefix = str_replace("../../add/teacher/", "", $picture_path);

    // Update teacher's picture in the database
    $sql_update_picture = "UPDATE Teachers SET picture = '$picture_path_without_prefix' WHERE teacher_id = $teacher_id";
    $conn->query($sql_update_picture);
  }

  // Update other teacher details in the database
  $sql_update_teacher = "UPDATE Teachers SET name = '$name', mobile = '$mobile', department_id = $department_id, position
= '$position', mail = '$mail' WHERE teacher_id = $teacher_id";
  $conn->query($sql_update_teacher);

  // Delete existing courses for the teacher
  $sql_delete_courses = "DELETE FROM TeacherCourses WHERE teacher_id = $teacher_id";
  $conn->query($sql_delete_courses);

  // Insert selected courses into TeacherCourses table
  foreach ($courses as $course_code) {
    $sql_insert_teacher_courses = "INSERT INTO TeacherCourses (teacher_id, course_id) SELECT $teacher_id, course_id FROM
Course WHERE course_code = '$course_code'";
    $conn->query($sql_insert_teacher_courses);
  }

  if ($conn->query($sql_update_teacher) === TRUE) {
    $_SESSION['success_message'] = "Successfully Teacher info Updated";
  } else {

    $_SESSION['error_message'] = "Error! Teacher info Not updated";
  }
  header('Location: teacher.php');
  exit;
}

// Retrieve teacher details from the database
$teacher_id = $_GET["id"];
$sql_teacher = "SELECT * FROM Teachers WHERE teacher_id = $teacher_id";
$result_teacher = $conn->query($sql_teacher);
$row_teacher = $result_teacher->fetch_assoc();

// Fetch departments for dropdown
$sql_departments = "SELECT * FROM department";
$result_departments = $conn->query($sql_departments);

// Fetch available courses
$sql_courses = "SELECT * FROM Course";
$result_courses = $conn->query($sql_courses);

// Fetch teacher's chosen courses
$sql_teacher_courses = "SELECT course_id FROM TeacherCourses WHERE teacher_id = $teacher_id";
$result_teacher_courses = $conn->query($sql_teacher_courses);
$teacher_courses = array();
while ($row = $result_teacher_courses->fetch_assoc()) {
  $teacher_courses[] = $row["course_id"];
}

?>
<div class="flex flex-col min-h-screen w-full">
  <div class="flex items-center justify-center flex-grow-2">

    <div
      class="relative mx-auto w-full max-w-md bg-white px-6 pt-10 mt-24 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:rounded-xl sm:px-10">
      <div class="w-full">
        <div class="text-center">
          <h1 class="text-2xl font-semibold text-gray-900">Update Teacher Info</h1>
        </div>
        <div class="mt-5">
          <form method="post" id="editTeacherForm" enctype="multipart/form-data">
            <input type="hidden" name="teacher_id" value="<?php echo $teacher_id; ?>"
              class="mt-1 p-2 block w-full rounded-md bg-gray-100 border border-gray-300">
            <div class="relative mt-6">
              <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
              <input type="text" id="name" name="name" value="<?php echo $row_teacher['name']; ?>" required
                class="mt-1 p-2 block w-full rounded-md bg-gray-100 border border-gray-300">
            </div>
            <div class="relative mt-6">
              <label for="mobile" class="block text-sm font-medium text-gray-700">Mobile Number:</label>
              <input type="text" id="mobile" name="mobile" value="<?php echo $row_teacher['mobile']; ?>" required
                class="mt-1 p-2 block w-full rounded-md bg-gray-100 border border-gray-300">
            </div>
            <div class="relative mt-6">
              <!-- <label for="department_id">Select Department:</label> -->
              <select id="department_id" name="department_id" required
                class="w-full text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-gray-300">
                <option value="" disabled>Select a department</option>
                <?php
                while ($row = $result_departments->fetch_assoc()) {
                  $department_id = $row['department_id'];
                  $department_name = $row['department_name'];
                  $selected = ($department_id == $row_teacher['department_id']) ? "selected" : "";
                  echo "<option value='$department_id' $selected>$department_name</option>";
                }
                ?>
              </select>
            </div>
            <div class="relative mt-6">
              <label for="position" class="block text-sm font-medium text-gray-700">Position:</label>
              <select id="position" name="position" required
                class="w-full text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-gray-300">
                <option value="" disabled>Select a position</option>
                <option value="Dean" <?php if ($row_teacher['position'] == 'Dean')
                  echo 'selected'; ?>>Dean</option>
                <option value="Professor" <?php if ($row_teacher['position'] == 'Professor')
                  echo 'selected'; ?>>Professor
                </option>
                <option value="Associate Professor" <?php if ($row_teacher['position'] == 'Associate Professor')
                  echo 'selected'; ?>>
                  Associate Professor</option>
                <option value="Assistant Professor" <?php if ($row_teacher['position'] == 'Assistant Professor')
                  echo 'selected'; ?>>
                  Assistant Professor</option>
                <option value="Lecturer" <?php if ($row_teacher['position'] == 'Lecturer')
                  echo 'selected'; ?>>Lecturer
                </option>
              </select>
            </div>
            <div class="relative mt-6">


              <label for="mail" class="block text-sm font-medium text-gray-700">Mail:</label>
              <input type="email" id="mail" name="mail" value="<?php echo $row_teacher['mail']; ?>" required
                class="mt-1 p-2 block w-full rounded-md bg-gray-100 border border-gray-300">
            </div>
            <div class="relative mt-6">

              <label for="picture" class="block text-sm font-medium text-gray-700">Picture:</label>
              <input type="file" id="picture" name="picture" required
                class="mt-1 p-2 block w-full rounded-md bg-gray-100 border border-gray-300">
            </div>
            <div class="relative mt-6">
              <?php if ($row_teacher['picture']) { ?>
                <img src="../../add/teacher/<?php echo $row_teacher['picture']; ?>" width="50" height="50">
              <?php } ?>
            </div>
            <div class="relative mt-6">

              <label for="selectCourse" class="block text-sm font-medium text-gray-700">Select Courses:</label><br>
              <?php
              while ($row = $result_courses->fetch_assoc()) {
                $course_id = $row['course_id'];
                $course_code = $row['course_code'];
                $course_name = $row['course_name'];
                $selected = (in_array($course_id, $teacher_courses)) ? "checked" : "";
                echo "<input type='checkbox' name='courses[]' value='$course_code' $selected class='mr-2 h-5 w-5 text-blue-500 border-gray-300 focus:ring-blue-500'> $course_name<br>";
              }
              ?>
            </div>
            <div class="my-6">

              <input type="submit" value="Update Teacher"
                class="w-full rounded-md bg-gray-900 px-3 py-2 text-white focus:bg-gray-400 focus:outline-none">
          </form>
          <p class="text-center text-sm text-gray-500">
            View All Teachers <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
            <a class="underline" href="./teacher.php">Here</a>
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