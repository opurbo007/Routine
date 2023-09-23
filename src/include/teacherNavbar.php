<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
  <div class="container mx-auto flex-container ">

    <!-- Sidenav -->
    <div class="nav-container">
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

            <a href="./dashboard.php"
              class="flex cursor-pointer items-center truncate rounded-[5px] px-6 py-[0.45rem] text-[0.85rem] text-white outline-none transition duration-300 ease-linear hover:bg-gray-300 hover:text-black hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none hover:text-black hover:no-underline">
              <span class="mr-4 h-5 w-5 hover:text-black">
                <i class="fa fa-user" aria-hidden="true"></i>
              </span>
              <span>Profile</span>
            </a>

          </li>
          <li class="relative pt-4">

            <a href="./routine.php"
              class="flex cursor-pointer items-center truncate rounded-[5px] px-6 py-[0.45rem] text-[0.85rem] text-white outline-none transition duration-300 ease-linear hover:bg-gray-300 hover:text-black hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none hover:text-black hover:no-underline">
              <span class="mr-4 h-5 w-5 hover:text-black">
                <i class="fa fa-tasks" aria-hidden="true"></i>
              </span>
              <span>Routine</span>
            </a>

          </li> <li class="relative pt-4">

<a href="./class.php"
  class="flex cursor-pointer items-center truncate rounded-[5px] px-6 py-[0.45rem] text-[0.85rem] text-white outline-none transition duration-300 ease-linear hover:bg-gray-300 hover:text-black hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none hover:text-black hover:no-underline">
  <span class="mr-4 h-5 w-5 hover:text-black">
  <i class="fa fa-compass" aria-hidden="true"></i>
  </span>
  <span>Current Class</span>
</a>

</li>

          <li class="relative pt-4">
            <a href="../../login/logout.php"
              class="flex cursor-pointer items-center truncate rounded-[5px] px-6 py-[0.45rem] text-[0.85rem] text-white outline-none transition duration-300 ease-linear hover:bg-gray-300 hover:text-black hover:no-underline">
              <span class="mr-4 h-5 w-5 hover:text-gray-300">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
              </span>
              <span>Log Out</span>
            </a>
          </li>

        </ul>
    </div>