<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DIU Daily</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="shortcut icon" href="src/img/logo.svg" type="image/x-icon">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Martian+Mono:wght@600&display=swap" rel="stylesheet">
  <style>

    @keyframes fadeInOut {
      0% {
        opacity: 0;
      }

      50% {
        opacity: 1;
      }

      100% {
        opacity: 0;
      }
    }

  
    .changing-text {
      animation: fadeInOut 3s ease-in-out infinite;
    }

 
       
    body {

      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-color: rgba(0, 0, 0, 0.5);
    }

       .font {
        font-family: 'Martian Mono', monospace;
    }
  </style>
</head>

<body class="bg-gray-100">
<div class="py-2 bg-gray-100 text-gray-900 min-h-screen">
<header class="px-5 sm:px-10 md:px-10 md:py-5 lg:px-20 flex items-center justify-between lg:mx-60 ">
      <div>
      <h1 class="text-black text-2xl font-bold font">DIU DAILY</h1>
      </div>
      <div x-data="{ navOpen: false }">
        <button @click="navOpen = true">
          <svg class="cursor-pointer text-gray-700 hover:text-gray-900 w-6 md:hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="12" x2="21" y2="12" />
            <line x1="3" y1="6" x2="21" y2="6" />
            <line x1="3" y1="18" x2="21" y2="18" />
          </svg>
        </button>
        <div :class="{'hidden': !navOpen}" class="md:block fixed top-0 inset-x-0 bg-white p-8 m-4 z-30 rounded-lg shadow md:rounded-none md:shadow-none md:p-0 md:m-0 md:relative md:bg-transparent">
          <button @click="navOpen = false" class="absolute top-0 right-0 mr-5 mt-5 md:hidden">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
              <path d="M18 6L6 18M6 6l12 12" />
            </svg>
          </button>
          <div class="flex flex-col items-center justify-center md:block">
            <a href="src/student/select.php" class="transition-all duration-100 ease-in-out pb-1 border-b-2 text-indigo-500 border-transparent hover:border-indigo-300
              hover:text-gray-600 md:mr-8 text-lg md:text-sm font-bold tracking-wide my-4 md:my-0">
              Student
        </a>
        <a href="login/teacher/login.php" class="transition-all duration-100 ease-in-out pb-1 border-b-2 text-indigo-500 border-transparent hover:border-indigo-300
              hover:text-indigo-600 md:mr-8 text-lg md:text-sm font-bold tracking-wide my-4 md:my-0">
              Teacher
        </a> 
        <a href="login/admin/login.php">
            <button class="border border-transparent rounded font-semibold tracking-wide text-lg md:text-sm px-5 py-3 md:py-2
              focus:outline-none focus:shadow-outline bg-indigo-600 text-gray-100 hover:bg-indigo-800
              hover:text-gray-200 transition-all duration-300 ease-in-out my-4 md:my-0 w-full md:w-auto">
             Admin
            </button>
           </a>
          </div>
        </div>
      </div>
   </header>



  <div class="min-h-screen flex flex-col justify-center">
    <div class="self-center items-center flex flex-col sm:flex-row w-full md:w-5/6 xl:w-2/3 px-4 sm:px-1 lg:-mt-40">
      <div class="w-full text-center sm:text-left sm:w-1/2 py-12 sm:px-8 ">
        <h1 class="tracking-wide text-indigo-600  text-2xl mb-6">Welcome To, <span
            class="text-gray-800 font-bold tracking tracking-widest">DIU DAILY</span></h1>

        <span class="content__container block font-light text-browngray text-2xl my-6 sm:my-12">
          <p class="content__container__list__item xl:pl-3 changing-text" id="changingText"></p>
        </span>
        <p class="font-bold tracking-widest text-4xl">Stay on Track with DIU Daily!</p>
      </div>
      <div class="w-full sm:w-1/2">
        <img src="src/img/cover3.png" alt="AWE.SOME header">
      </div>
    </div>
    <script>
      const textArray = [
        "Your Daily University Routine at Your Fingertip",
        "Stay Organized and Thrive"
      ];

      const changingText = document.getElementById("changingText");
      let currentIndex = 0;

      function changeText() {
        changingText.textContent = textArray[currentIndex];
        currentIndex = (currentIndex + 1) % textArray.length;
      }

      changeText();
      setInterval(changeText, 3000);

      // JavaScript to hide/show button container based on screen width
      const btnContainer = document.getElementById("btnContainer");

      const btnContainer2 = document.getElementById("btnContainer2");

   
    </script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.x.x/dist/alpine.js" defer></script>

  </div>
</body>

</html>