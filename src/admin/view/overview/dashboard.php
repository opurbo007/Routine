<?php
include("../../../include/auth.php");
include("../../../../database/config.php");
include("../../../include/adminNavbar.php");

$sql = "SELECT
    (SELECT COUNT(*) FROM teachers) AS teachers,
    (SELECT COUNT(*) FROM department) AS departments,
    (SELECT COUNT(*) FROM course) AS courses,
    (SELECT COUNT(*) FROM timeslot) AS timeslots,
    (SELECT COUNT(*) FROM batch) AS batch,
    (SELECT COUNT(*) FROM room WHERE room_type = 'theory') AS theory_rooms,
    (SELECT COUNT(*) FROM room WHERE room_type = 'lab') AS lab_rooms";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


$totalTeachers = $row['teachers'];
$totalDepartments = $row['departments'];
$totalCourses = $row['courses'];
$totalTimeslots = $row['timeslots'];
$totalRoom = $row['theory_rooms'] + $row['lab_rooms'];
$totalTheoryRooms = $row['theory_rooms'];
$totalLabRooms = $row['lab_rooms'];
$totalBatch = $row['batch'];


mysqli_close($conn);
?>
<style>
  .border-gradient {
    border: 2px solid transparent;
    background-clip: padding-box;
    border-image: linear-gradient(to right, #93C5FD, #38A169);
    border-image-slice: 1;
  }
</style>

<body>
  <div class="container mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-16 text-center">DIU DASHBOARD</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-24">

      <a href="../teacher/teacher.php" class="hover:no-underline hover:text-black">
        <div class="bg-white shadow-lg rounded-lg p-10 border-gradient text-center ">
          <h2 class="text-xl font-semibold pb-4">Total Teachers <i class="fa fa-users" aria-hidden="true"></i></h2>
          <p class="text-3xl font-bold ">
            <?= $totalTeachers ?>
          </p>
        </div>
      </a>
      <a href="../dept/dept.php" class="hover:no-underline hover:text-black">
        <div class="bg-white shadow-lg rounded-lg p-10 border-gradient text-center ">
          <h2 class="text-xl font-semibold pb-4">Total Departments <i class="fa fa-sitemap" aria-hidden="true"></i>
          </h2>
          <p class="text-3xl font-bold">
            <?= $totalDepartments ?>
          </p>
        </div>
      </a>
      <a href="../course/course.php" class="hover:no-underline hover:text-black">
        <div class="bg-white shadow-lg rounded-lg p-10 border-gradient text-center ">
          <h2 class="text-xl font-semibold pb-4">Total Courses <i class="fa fa-book" aria-hidden="true"></i></h2>
          <p class="text-3xl font-bold">
            <?= $totalCourses ?>
          </p>
        </div>
      </a>
      <a href="../time/timetable.php" class="hover:no-underline hover:text-black">
        <div class="bg-white shadow-lg rounded-lg p-10 border-gradient text-center ">
          <h2 class="text-xl font-semibold pb-4">Total Timeslot <i class="fa fa-clock" aria-hidden="true"></i></h2>
          <p class="text-3xl font-bold">
            <?= $totalTimeslots ?>
          </p>
        </div>
      </a>

      <a href="../batch/batch.php" class="hover:no-underline hover:text-black">
        <div class="bg-white shadow-lg rounded-lg p-10 border-gradient text-center ">
          <h2 class="text-xl font-semibold pb-4">Total Batch <i class="fa fa-cubes" aria-hidden="true"></i></h2>
          <p class="text-3xl font-bold">
            <?= $totalBatch ?>
          </p>
        </div>
      </a><a href="../room/room.php" class="hover:no-underline hover:text-black">
        <div class="bg-white shadow-lg rounded-lg p-10 border-gradient text-center ">
          <h2 class="text-xl font-semibold pb-4">Total Rooms <i class="fa fa-building" aria-hidden="true"></i></h2>
          <p class="text-3xl font-bold">
            <?= $totalRoom ?>
          </p>
        </div>
      </a>
      <a href="../room/room.php" class="hover:no-underline hover:text-black">
        <div class="bg-white shadow-lg rounded-lg p-10 border-gradient text-center ">
          <h2 class="text-xl font-semibold pb-4">Total Regular Rooms <i class="fa fa-window-maximize"
              aria-hidden="true"></i>
          </h2>
          <p class="text-3xl font-bold">
            <?= $totalTheoryRooms ?>
          </p>
        </div>
      </a>
      <a href="../room/room.php" class="hover:no-underline hover:text-black">
        <div class="bg-white shadow-lg rounded-lg p-10 border-gradient text-center ">
          <h2 class="text-xl font-semibold pb-4">Total LAB <i class="fa fa-flask" aria-hidden="true"></i></h2>
          <p class="text-3xl font-bold">
            <?= $totalLabRooms ?>
          </p>
        </div>
      </a>


    </div>

    <script src="../../../include/index.js"></script>


</body>

</html>