<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
  <title>DIU DAILY</title>
  <style>
    .flex-container {
      display: flex;
    }

    .nav-container {
      flex: 0 0 200px;
    }

    .content-container {
      flex: 1;
      margin-left: 40px;
    }

    .nav-container,
    .toggle-button {
      transition: transform 3s ease-in-out;
    }

    .font {
      font-family: 'Orbitron', sans-serif;
    }
  </style>
</head>

<body class="bg-gray-100 ">
  <!-- show when navber is close -->
  <button class="absolute top-4 left-4 bg-gray-700 text-white px-3 py-1 rounded-md" onclick="toggleNavbar()">
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
  </button>

  <!-- ---------------------------- -->
  <div class="container mx-auto md:flex ">

    <!-- Sidenav -->
    <div class="nav-container md:w-60 md:fixed md:left-0 md:top-0 md:h-full md:bg-zinc-800 transform md:transform-none"
      :class="{'translate-x-0': navActive, '-translate-x-full': !navActive}">
      <nav class="fixed left-0 top-0 z-[1035] h-full w-60  overflow-hidden bg-zinc-800" id="sidenav-1">
        <!-- Navbar content -->
        <div class="mb-3 flex items-center justify-center border-b-2 border-solid border-gray-100 py-6  outline-none">
          <img id="logo" class="mr-4 w-12" src="../img/logo.png" alt="Logo" />
          <span class="text-white font mr-8">DIU DAILY</span>

          <span class="text-white cursor-pointer" onclick="toggleNavbar()">
            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
          </span>
        </div>
        <ul class="relative m-0 list-none px-[0.2rem] pb-12">
          <li class="relative pt-4">

            <a href="../admin/add/add_teacher.php"
              class="flex cursor-pointer items-center truncate rounded-[5px] px-6 py-[0.45rem] text-[0.85rem] text-white outline-none transition duration-300 ease-linear hover:bg-gray-300 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none  ">
              <span class="mr-4 h-5 w-5 hover:text-gray-300">
                <i class="fas fa-home"></i>
              </span>
              <span>Overview</span>
            </a>

          </li>
          <li class="relative pt-4">
            <div
              class="flex cursor-pointer items-center truncate rounded-[5px] px-6 py-[0.45rem] text-[0.85rem] text-white outline-none transition duration-300 ease-linear hover:bg-gray-300 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none  "
              onclick="dropdownRoutine()">


              <span class="mr-4 h-5 w-5 hover:text-gray-300">
                <i class="fa fa-tasks" aria-hidden="true"></i>
              </span>
              <span>Schedule</span>
              <span class="ml-auto cursor-pointer rotate-180" id="arrow3">
                <i class="bi bi-chevron-down"></i>
              </span>
            </div>
            <div class="text-left text-sm mt-2 w-full mx-auto text-gray-200" id="submenuRoutine">
              <!-- inside dropdown  -->
              <a href="../admin/routine/generate/select.php">
                <h1 class="cursor-pointer py-2 ml-16 pl-2 hover:bg-gray-300 hover:text-black rounded-md mt-1">Make
                  Routine
                </h1>
              </a>
              <a href="../admin/routine/show/select.php">
                <h1 class="cursor-pointer py-2 ml-16 pl-2 hover:bg-gray-300 hover:text-black rounded-md mt-1">View
                  Routine
                </h1>
              </a>
            </div>
          </li>
          <li class="relative pt-4">
            <div
              class="flex cursor-pointer items-center truncate rounded-[5px] px-6 py-[0.45rem] text-[0.85rem] text-white outline-none transition duration-300 ease-linear hover:bg-gray-300 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none  "
              onclick="dropdown()">


              <span class="mr-4 h-5 w-5 hover:text-gray-300">
                <i class="fas fa-user-plus"></i>
              </span>
              <span>Add</span>
              <span class="ml-auto cursor-pointer rotate-180" id="arrow">
                <i class="bi bi-chevron-down"></i>
              </span>
            </div>
            <div class="text-left text-sm mt-2 w-full mx-auto text-gray-200" id="submenu">
              <!-- inside dropdown  -->
              <a href="../admin/add/add_teacher.php">
                <h1 class="cursor-pointer py-2 ml-16 pl-2 hover:bg-gray-300 hover:text-black rounded-md mt-1">Teacher
                </h1>
              </a>
              <a href="../admin/add/add_batch.php">
                <h1 class="cursor-pointer py-2 ml-16 pl-2 hover:bg-gray-300 hover:text-black rounded-md mt-1">Batch
                </h1>
              </a>
              <a href="../admin/add/add_department.php">
                <h1 class="cursor-pointer py-2 ml-16 pl-2 hover:bg-gray-300 hover:text-black rounded-md mt-1">Department
                </h1>
              </a>
              <a href="../admin/add/add_semester.php">
                <h1 class="cursor-pointer py-2 ml-16 pl-2 hover:bg-gray-300 hover:text-black rounded-md mt-1">Semeter
                </h1>
              </a>
              <a href="../admin/add/add_course.php">
                <h1 class="cursor-pointer py-2 ml-16 pl-2 hover:bg-gray-300 hover:text-black rounded-md mt-1">Course
                </h1>
              </a>
              <a href="../admin/add/add_room.php">
                <h1 class="cursor-pointer py-2 ml-16 pl-2 hover:bg-gray-300 hover:text-black rounded-md mt-1">Room
                </h1>
              </a>

              <a href="../admin/add/add_timetable.php">
                <h1 class="cursor-pointer py-2 ml-16 pl-2 hover:bg-gray-300 hover:text-black rounded-md mt-1">Timeslot
                </h1>
              </a>

            </div>
          </li>
          <!-- for showing component  -->
          <li class="relative pt-4">
            <div
              class="flex cursor-pointer items-center truncate rounded-[5px] px-6 py-[0.45rem] text-[0.85rem] text-white outline-none transition duration-300 ease-linear hover:bg-gray-300 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none  "
              onclick="dropdownview()">


              <span class="mr-4 h-5 w-5 hover:text-gray-300">
                <i class="fas fa-user-plus"></i>
              </span>
              <span>View</span>
              <span class="ml-auto cursor-pointer rotate-180" id="arrow2">
                <i class="bi bi-chevron-down"></i>
              </span>
            </div>
            <div class="text-left text-sm mt-2 w-full mx-auto text-gray-200" id="submenuview">
              <!-- inside dropdown  -->
              <a href="../admin/teacher/teacher.php">
                <h1 class="cursor-pointer py-2 ml-16 pl-2 hover:bg-gray-300 hover:text-black rounded-md mt-1">Teacher
                </h1>
              </a>
              <a href="../admin/batch/batch.php">
                <h1 class="cursor-pointer py-2 ml-16 pl-2 hover:bg-gray-300 hover:text-black rounded-md mt-1">Batch
                </h1>
              </a>
              <a href="../admin/dept/dept.php">
                <h1 class="cursor-pointer py-2 ml-16 pl-2 hover:bg-gray-300 hover:text-black rounded-md mt-1">Department
                </h1>
              </a>
              <a href="../admin/semester/semester.php">
                <h1 class="cursor-pointer py-2 ml-16 pl-2 hover:bg-gray-300 hover:text-black rounded-md mt-1">Semeter
                </h1>
              </a>
              <a href="../admin/course/course.php">
                <h1 class="cursor-pointer py-2 ml-16 pl-2 hover:bg-gray-300 hover:text-black rounded-md mt-1">Course
                </h1>
              </a>
              <a href="../admin/room/room.php">
                <h1 class="cursor-pointer py-2 ml-16 pl-2 hover:bg-gray-300 hover:text-black rounded-md mt-1">Room
                </h1>
              </a>

              <a href="../admin/time/timetable.php">
                <h1 class="cursor-pointer py-2 ml-16 pl-2 hover:bg-gray-300 hover:text-black rounded-md mt-1">Timeslot
                </h1>
              </a>

            </div>
          </li>
          <li class="relative pt-4">

            <a href="../admin/add/add_teacher.php"
              class="flex cursor-pointer items-center truncate rounded-[5px] px-6 py-[0.45rem] text-[0.85rem] text-white outline-none transition duration-300 ease-linear hover:bg-gray-300 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none  ">
              <span class="mr-4 h-5 w-5 hover:text-gray-300">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
              </span>
              <span>Log Out</span>
            </a>

          </li>
        </ul>
    </div>
  </div>

  <script type="text/javascript">
    function dropdown() {
      document.querySelector("#submenu").classList.toggle("hidden");
      document.querySelector("#arrow").classList.toggle("rotate-0");
    }
    dropdown();
    function dropdownview() {
      document.querySelector("#submenuview").classList.toggle("hidden");
      document.querySelector("#arrow2").classList.toggle("rotate-0");
    }
    dropdownview();

    function dropdownRoutine() {
      document.querySelector("#submenuRoutine").classList.toggle("hidden");
      document.querySelector("#arrow3").classList.toggle("rotate-0");
    }
    dropdownRoutine();


    function toggleNavbar() {
      const navContainer = document.querySelector(".nav-container");
      const toggleButton = document.querySelector(".toggle-button");

      navContainer.classList.toggle("hidden");
      toggleButton.classList.toggle("hidden");
    }
    let navActive = false;

    function toggleNavbar() {
      navActive = !navActive;
    }
  </script>