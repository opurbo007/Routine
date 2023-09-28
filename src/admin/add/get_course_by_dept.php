<?php
include("../../../database/config.php");


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["department_id"])) {
  $department_id = $_GET["department_id"];

  // Fetch courses for the selected department
  $sql_courses = "SELECT * FROM Course WHERE department_id = $department_id";
  $result_courses = $conn->query($sql_courses);

  if ($result_courses->num_rows > 0) {
    echo "<ul>";
    while ($row = $result_courses->fetch_assoc()) {
      $course_code = $row["course_code"];
      $course_name = $row["course_name"];
      echo "<li class='flex items-center mb-2 border border-gray-300 rounded p-2 shadow-sm'>
      <input type='checkbox' name='courses[]' value='$course_code' class='mr-2 h-5 w-5 text-blue-500 border-gray-300 focus:ring-blue-500'>
      <span class='text-black'>$course_name</span>
  </li>";


    }
    echo "</ul>";
  } else {
    echo "<p class='text-red-500 text-center font-semibold mt-4'>No courses available for this department.</p>";
  }
}

// Close the database connection
$conn->close();
?>