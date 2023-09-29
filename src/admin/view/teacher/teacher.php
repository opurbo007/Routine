<?php

include("../../../include/auth.php");
ob_start();

include("../../../../database/config.php");
include("../../../include/adminNavbar.php");


?>
<div class="flex flex-col min-h-screen w-full">


  <?php
  // if update,  this alart will show
  if (isset($_SESSION['success_message'])) {

    $successMessage = $_SESSION['success_message'];
    echo '<div class="flex items-center justify-center mt-6">  
         <div id="successMessage" class="flex w-96 shadow-lg rounded-lg">
             <div class="bg-green-600 py-4 px-6 rounded-l-lg flex items-center">
                 <i class="fas fa-check text-white"></i>
             </div>
            <div class="relative px-4 py-6 bg-white rounded-r-lg flex justify-between items-center w-full border border-l-transparent border-gray-200">
                <div>' . $successMessage . '</div>
                <div class="absolute bottom-0 left-0 w-full h-1 bg-green-600"></div>
            </div>
        </div>
    </div>';


    unset($_SESSION['success_message']);
  }


  if (isset($_SESSION['error_message'])) {

    $errorMessage = $_SESSION['error_message'];
    echo '<div class="flex items-center justify-center mt-6">  
         <div id="errorMessage" class="flex w-96 shadow-lg rounded-lg">
             <div class="bg-red-600 py-4 px-6 rounded-l-lg flex items-center">
                 <i class="fas fa-times text-white"></i>
             </div>
            <div class="relative px-4 py-6 bg-white rounded-r-lg flex justify-between items-center w-full border border-l-transparent border-gray-200">
                <div>' . $errorMessage . '</div>
                <div class="absolute bottom-0 left-0 w-full h-1 bg-red-600"></div>
            </div>
        </div>
    </div>';

    unset($_SESSION['error_message']);
  }

  if (isset($_SESSION['delete'])) {
    $msg = $_SESSION['delete'];

    echo '<div class="flex items-center justify-center mt-6">  
         <div id="successMessage" class="flex w-96 shadow-lg rounded-lg">
             <div class="bg-green-600 py-4 px-6 rounded-l-lg flex items-center">
                 <i class="fas fa-check text-white"></i>
             </div>
            <div class="relative px-4 py-6 bg-white rounded-r-lg flex justify-between items-center w-full border border-l-transparent border-gray-200">
                <div>' . $msg . '</div>
                <div class="absolute bottom-0 left-0 w-full h-1 bg-green-600"></div>
            </div>
        </div>
    </div>';
    unset($_SESSION['delete']);
  }

  if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    echo '<div class="flex items-center justify-center mt-6">  
    <div id="errorMessage" class="flex w-96 shadow-lg rounded-lg">
        <div class="bg-red-600 py-4 px-6 rounded-l-lg flex items-center">
            <i class="fas fa-times text-white"></i>
        </div>
        <div class="relative px-4 py-6 bg-white rounded-r-lg flex justify-between items-center w-full border border-l-transparent border-gray-200">
            <div>' . $error . '</div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-red-600"></div>
        </div>
      </div>
    </div>';


    unset($_SESSION['error']);
  } ?>


  <div class="flex justify-between my-4 ">
    <p class="border border-black">
      <a href="../../add/dept/add_department.php"
        class="inline-block px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-600 hover:no-underline">
        Add Department
      </a>
    </p>
    <!-- Search Form -->
    <form method="get" class="flex">

      <input type="text" id="search" name="search"
        class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
        placeholder="Search by name, Dept, Position, email or phone">
      <button type="submit" value="Search" class="ml-2 bg-gray-900 hover:bg-gray-600 text-white py-2 px-4 rounded"><i
          class="fa fa-search" aria-hidden="true"></i></button>
    </form>
  </div>

  <!-- Teacher List -->
  <div>
    <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
      <thead class="bg-gray-200">
        <tr>
          <th class="px-4 py-2">Picture</th>
          <th class="px-4 py-2">Name</th>
          <th class="px-4 py-2">Mobile</th>
          <th class="px-4 py-2">Email</th>
          <th class="px-4 py-2">Department</th>
          <th class="px-4 py-2">Position</th>
          <th class="px-4 py-2">Courses</th>
          <th class="px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $search = $_GET['search'] ?? '';
        $sql = "SELECT Teachers.*, department_name, GROUP_CONCAT(CONCAT(Course.course_code, ' - ', Course.course_name) SEPARATOR ', ') AS courses
    FROM Teachers
    INNER JOIN department ON Teachers.department_id = department.department_id
    LEFT JOIN TeacherCourses ON Teachers.teacher_id = TeacherCourses.teacher_id
    LEFT JOIN Course ON TeacherCourses.course_id = Course.course_id
    WHERE 
      Teachers.name LIKE '%$search%'
      OR Teachers.mail LIKE '%$search%'
      OR Teachers.mobile LIKE '%$search%'
      OR Teachers.position LIKE '%$search%'
      OR department.department_name LIKE '%$search%'
    GROUP BY Teachers.teacher_id
    ORDER BY
      CASE
        WHEN Teachers.position = 'Dean' THEN 1
        WHEN Teachers.position = 'Professor' THEN 2
        WHEN Teachers.position = 'Associate Professor' THEN 3
        WHEN Teachers.position = 'Assistant Professor' THEN 4
        WHEN Teachers.position = 'Lecturer' THEN 5
        ELSE 6 
      END";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
              <td class="border px-4 py-2 ">
                <img src="../../add/teacher/<?php echo $row['picture']; ?>" width='70' height='70'>
              </td>
              <td class="border px-4 py-2 ">
                <?php echo $row['name']; ?>
              </td>
              <td class="border px-4 py-2">
                <?php echo $row['mobile']; ?>
              </td>
              <td class="border px-4 py-2">
                <?php echo $row['mail']; ?>
              </td>
              <td class="border px-4 py-2 ">
                <?php echo $row['department_name']; ?>
              </td>
              <td class="border px-4 py-2">
                <?php echo $row['position']; ?>
              </td>
              <td class="border px-4 py-2">
                <select
                  class="text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-2 py-2.5"
                  style="width: 150px;">
                  <option value="" class="bg-white py-2 hover:bg-gray-100">Chosen Courses</option>
                  <?php
                  // Display chosen courses 
                  $courses = explode(', ', $row['courses']);
                  foreach ($courses as $course) {
                    echo "<option value='$course'>$course</option>";
                  }
                  ?>
                </select>

              </td>

              <td class="border px-4 py-2">
                <a href="edit_teacher.php?action=edit&id=<?php echo $row['teacher_id']; ?>"
                  class="text-blue-500 text-black mr-2 hover:text-black">
                  <i class="fa fa-pencil-square" aria-hidden="true"></i>
                </a>

                <a href="delete.php?action=delete&id=<?php echo $row['teacher_id']; ?>"
                  class="text-red-500 hover:text-black"
                  onclick='return confirm("Are you sure you want to delete this Teacher ID?");'>
                  <i class="fa fa-trash" aria-hidden="true"></i>
                </a>
              </td>

            </tr>
            <?php
          }
        } else {
          echo "<tr><td colspan='8' class='text-center'>No teachers found.</td></tr>";
        }


        ?>
      </tbody>
    </table>

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