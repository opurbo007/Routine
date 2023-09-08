<?php
session_start();
include("../../database/config.php");
include("../include/teacherNavbar.php");
?>

<div class="flex flex-col min-h-screen w-full">
  <?php
  // Check the teacher authentication
  if (isset($_SESSION["teacher_id"])) {
    $teacherId = $_SESSION["teacher_id"];

    // Teacher's profile info
    $query = "SELECT name, position, department_id, picture, mail, mobile FROM teachers WHERE teacher_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $teacherId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $teacher = $result->fetch_assoc();

      // Fetch department name from the department table
      $departmentQuery = "SELECT department_name FROM department WHERE department_id = ?";
      $departmentStmt = $conn->prepare($departmentQuery);
      $departmentStmt->bind_param("i", $teacher["department_id"]);
      $departmentStmt->execute();
      $departmentResult = $departmentStmt->get_result();

      if ($departmentResult->num_rows > 0) {
        $departmentRow = $departmentResult->fetch_assoc();
        $departmentName = $departmentRow["department_name"];
      } else {
        $departmentName = "Department not found";
      }

      ?>
      <div class="content-container mt-10 py-20 ">
        <div id="about" class="relative bg-white overflow-hidden mt-16">
          <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
              <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
                fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                <polygon points="50,0 100,0 50,100 0,100"></polygon>
              </svg>
              <div class="pt-1"></div>
              <main class=" mx-auto max-w-7xl py-20 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                <div class="sm:text-center lg:text-left">
                  <h2 class="mt-10 text-2xl tracking-tight font-extrabold text-gray-900 sm:text-3xl md:text-4xl">
                    <?php echo $teacher['name']; ?>
                  </h2>
                  <p class="text-xl">
                    <?php echo $teacher['position']; ?>
                  </p>
                  <p class="text-xl">Department of
                    <?php echo $departmentName; ?>
                  </p>
                  <p class="text-2xl">Dhaka Internation University</p>
                  <p class="">Mobile:
                    <?php echo $teacher['mobile']; ?>
                  </p>
                  <p class="">Email:
                    <?php echo $teacher['mail']; ?>
                  </p>

                </div>
              </main>
            </div>
          </div>
          <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">

            <img src='../admin/add/teacher/<?php echo $teacher['picture']; ?>' alt='../admin/add/teacher/uploads/dump.png'
              class="h-56 w-full object-cover object-top sm:h-72 md:h-96 lg:w-full lg:h-full">
          </div>
        </div>
      </div>
    </div>
    <?php

    } else {
      echo "Teacher not found";
    }
  } else {
    echo "You are not authorized to view this page.";
  }

  $conn->close();
  ?>
</div>
</div>
<script src="../include/index.js"></script>
</body>

</html>