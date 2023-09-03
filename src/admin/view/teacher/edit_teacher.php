<!DOCTYPE html>
<html>

<head>
  <title>Edit Teacher</title>
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
      $picture_path = "uploads/" . $picture;

      // Move the uploaded picture to the uploads directory
      move_uploaded_file($picture_tmp, $picture_path);

      // Update teacher's picture in the database
      $sql_update_picture = "UPDATE Teachers SET picture = '$picture_path' WHERE teacher_id = $teacher_id";
      $conn->query($sql_update_picture);
    }

    // Update other teacher details in the database
    $sql_update_teacher = "UPDATE Teachers SET name = '$name', mobile = '$mobile', department_id = $department_id, position = '$position', mail = '$mail' WHERE teacher_id = $teacher_id";
    $conn->query($sql_update_teacher);

    // Delete existing courses for the teacher
    $sql_delete_courses = "DELETE FROM TeacherCourses WHERE teacher_id = $teacher_id";
    $conn->query($sql_delete_courses);

    // Insert selected courses into TeacherCourses table
    foreach ($courses as $course_code) {
      $sql_insert_teacher_courses = "INSERT INTO TeacherCourses (teacher_id, course_id) SELECT $teacher_id, course_id FROM Course WHERE course_code = '$course_code'";
      $conn->query($sql_insert_teacher_courses);
    }

    echo "<p>Teacher details updated successfully!</p>";
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

  <h2>Edit Teacher</h2>
  <form method="post" id="editTeacherForm" enctype="multipart/form-data">
    <input type="hidden" name="teacher_id" value="<?php echo $teacher_id; ?>">

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $row_teacher['name']; ?>" required><br><br>

    <label for="mobile">Mobile Number:</label>
    <input type="text" id="mobile" name="mobile" value="<?php echo $row_teacher['mobile']; ?>" required><br><br>

    <label for="department_id">Select Department:</label>
    <select id="department_id" name="department_id" required>
      <option value="" disabled>Select a department</option>
      <?php
      while ($row = $result_departments->fetch_assoc()) {
        $department_id = $row['department_id'];
        $department_name = $row['department_name'];
        $selected = ($department_id == $row_teacher['department_id']) ? "selected" : "";
        echo "<option value='$department_id' $selected>$department_name</option>";
      }
      ?>
    </select><br><br>

    <label for="position">Position:</label>
    <select id="position" name="position" required>
      <option value="" disabled>Select a position</option>
      <option value="Professor" <?php if ($row_teacher['position'] == 'Professor')
        echo 'selected'; ?>>Professor</option>
      <option value="Associate Professor" <?php if ($row_teacher['position'] == 'Associate Professor')
        echo 'selected'; ?>>Associate Professor</option>
      <option value="Assistant Professor" <?php if ($row_teacher['position'] == 'Assistant Professor')
        echo 'selected'; ?>>Assistant Professor</option>
      <option value="Lecturer" <?php if ($row_teacher['position'] == 'Lecturer')
        echo 'selected'; ?>>Lecturer</option>
    </select><br><br>

    <label for="mail">Mail:</label>
    <input type="email" id="mail" name="mail" value="<?php echo $row_teacher['mail']; ?>" required><br><br>

    <label for="picture">Picture:</label>
    <input type="file" id="picture" name="picture"><br>
    <?php if ($row_teacher['picture']) { ?>
      <img src="<?php echo $row_teacher['picture']; ?>" width="50" height="50">
    <?php } ?><br><br>

    <label for="selectCourse">Select Courses:</label><br>
    <?php
    while ($row = $result_courses->fetch_assoc()) {
      $course_id = $row['course_id'];
      $course_code = $row['course_code'];
      $course_name = $row['course_name'];
      $selected = (in_array($course_id, $teacher_courses)) ? "checked" : "";
      echo "<input type='checkbox' name='courses[]' value='$course_code' $selected> $course_code - $course_name<br>";
    }
    ?><br>

    <input type="submit" value="Update Teacher">
  </form>

  <?php
  // Close the database connection
  $conn->close();
  ?>
</body>

</html>