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

<body>
  <div class="container mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-4">Educational Institution Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
      <div class="bg-blue-200 p-4 rounded-lg">
        <h2 class="text-xl font-semibold">Total Teachers</h2>
        <p class="text-3xl font-bold">
          <?= $totalTeachers ?>
        </p>
      </div>
      <div class="bg-green-200 p-4 rounded-lg">
        <h2 class="text-xl font-semibold">Total Departments</h2>
        <p class="text-3xl font-bold">
          <?= $totalDepartments ?>
        </p>
      </div>
      <div class="bg-yellow-200 p-4 rounded-lg">
        <h2 class="text-xl font-semibold">Total Courses</h2>
        <p class="text-3xl font-bold">
          <?= $totalCourses ?>
        </p>
      </div>
      <div class="bg-red-200 p-4 rounded-lg">
        <h2 class="text-xl font-semibold">Total Timeslots</h2>
        <p class="text-3xl font-bold">
          <?= $totalTimeslots ?>
        </p>
      </div>
      <div class="bg-red-200 p-4 rounded-lg">
        <h2 class="text-xl font-semibold">Total Rooms</h2>
        <p class="text-3xl font-bold">
          <?= $totalRoom ?>
        </p>
      </div>
      <div class="bg-red-200 p-4 rounded-lg">
        <h2 class="text-xl font-semibold">Total Batch</h2>
        <p class="text-3xl font-bold">
          <?= $totalBatch ?>
        </p>
      </div>
      <div class="bg-red-200 p-4 rounded-lg">
        <h2 class="text-xl font-semibold">Total Theory Rooms</h2>
        <p class="text-3xl font-bold">
          <?= $totalTheoryRooms ?>
        </p>
      </div>
      <div class="bg-red-200 p-4 rounded-lg">
        <h2 class="text-xl font-semibold">Total Lab Rooms</h2>
        <p class="text-3xl font-bold">
          <?= $totalLabRooms ?>
        </p>
      </div>
    </div>
  </div>

  <script src="../../../include/index.js"></script>


</body>

</html>