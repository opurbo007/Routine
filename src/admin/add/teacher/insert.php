<?php
session_start();
include("../../../../database/config.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $mobile = $_POST["mobile"];
  $department_id = $_POST["department_id"];
  $position = $_POST["position"];
  $mail = $_POST["mail"];
  $password = $_POST["password"];
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  $courses = $_POST["courses"];

  // Check if the teacher with the given mobile number already exists
  $sql_check_teacher = "SELECT * FROM Teachers WHERE mobile = '$mobile'";
  $result_check_teacher = $conn->query($sql_check_teacher);


  if ($result_check_teacher->num_rows > 0) {
    $_SESSION["exist"] = "Teacher with the given mobile number already exists!";
  } else {
    // Handle picture upload
    if ($_FILES["picture"]["error"] === UPLOAD_ERR_OK) {
      $picture_name = $_FILES["picture"]["name"];
      $picture_tmp_name = $_FILES["picture"]["tmp_name"];
      $picture_destination = "uploads/" . $picture_name; // Adjust the destination directory as needed

      if (move_uploaded_file($picture_tmp_name, $picture_destination)) {
        // Picture uploaded successfully, proceed with database insertion
        $sql_insert_teacher = "INSERT INTO Teachers (name, mobile, department_id, position, mail, password, picture) VALUES ('$name', '$mobile', $department_id, '$position', '$mail', '$hashed_password', '$picture_destination')";

        if ($conn->query($sql_insert_teacher) === TRUE) {
          $teacher_id = $conn->insert_id;

          // Insert selected courses into TeacherCourses table
          foreach ($courses as $course_code) {
            $sql_insert_teacher_courses = "INSERT INTO TeacherCourses (teacher_id, course_id) SELECT $teacher_id, course_id FROM Course WHERE course_code = '$course_code'";
            $conn->query($sql_insert_teacher_courses);
          }

          $_SESSION['success_message'] = "Successfully Tteacher Added";


          header('Location: add_teacher.php');
          exit;
        } else {
          $_SESSION['error_message'] = "Error! Teacher Not Added";


          header('Location: add_teacher.php');
          exit;
        }
      } else {
        $_SESSION['error_pic'] = "Error! Uploding picture";


        header('Location: add_teacher.php');
        exit;
      }
    } else {
      $_SESSION['error_pic2'] = ' .$_FILES["picture"]["error"].';

      header('Location: add_teacher.php');
      exit;

    }
  }
}

?>