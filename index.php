<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DIU Daily</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Add CSS for the animation */
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

    /* Apply the animation to the changing text */
    .changing-text {
      animation: fadeInOut 3s ease-in-out infinite;
    }

    /* Position the buttons at the bottom */
    .btn-container {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background-color: white;
      display: flex;
      justify-content: space-around;
      padding: 10px;
      box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.1);
      z-index: 9999;
    }
  </style>
</head>

<body class="bg-gray-100">
  <!-- for big screen  -->
  <div class="fixed left-0 top-0 h-full p-4 flex flex-col items-start" id="btnContainer2">
    <div class="m-auto">
      <div class="mb-6 sm:mb-36 transform -rotate-90">
        <a class="px-6 py-2 text-gray-200 bg-purple-600 rounded-full shadow-md text-lg hover:bg-gray-800 hover:border-red"
          href="src/student/select.php">Student</a>
      </div>
      <div class="mb-6 sm:mb-36 transform -rotate-90">
        <a class="px-6 py-2 text-gray-200 bg-purple-600 rounded-full shadow-md text-lg hover:bg-gray-800 hover:border-red"
          href="login/admin/login.php">Admin</a>
      </div>
      <div class="mb-6 sm:mb-36 transform -rotate-90">
        <a class="px-6 py-2 text-gray-200 bg-purple-600 rounded-full shadow-md text-lg hover:bg-gray-800 hover:border-red"
          href="login/teacher/login.php">Teacher</a>
      </div>
    </div>
  </div>

  <!-- Button container for mobile -->
  <div class="btn-container bg-gray-100 flex justify-start" id="btnContainer">
    <span class="mr-1">
      <a class="px-6 py-2 text-gray-200 bg-purple-600 rounded-full shadow-md text-lg hover:bg-gray-800 hover:border-red"
        href="src/student/select.php">Student</a>
    </span>
    <span class="mr-1">
      <a class="px-6 py-2 text-gray-200 bg-purple-600 rounded-full shadow-md text-lg hover:bg-gray-800 hover:border-red"
        href="login/admin/login.php">Admin</a>
    </span>
    <span class="">
      <a class="px-6 py-2 text-gray-200 bg-purple-600 rounded-full shadow-md text-lg hover:bg-gray-800 hover:border-red"
        href="login/teacher/login.php">Teacher</a>
    </span>
  </div>


  <div class="min-h-screen flex flex-col justify-center">
    <div class="self-center items-center flex flex-col sm:flex-row w-full md:w-5/6 xl:w-2/3 px-4 sm:px-0">
      <div class="w-full text-center sm:text-left sm:w-1/2 py-12 sm:px-8">
        <h1 class="tracking-wide text-purple-600 text-2xl mb-6">Welcome To, <span
            class="text-gray-800 font-bold tracking tracking-widest">DIU DAILY</span></h1>

        <span class="content__container block font-light text-browngray text-2xl my-6 sm:my-12">
          <p class="content__container__list__item xl:pl-3 changing-text" id="changingText"></p>
        </span>
        <p class="font-bold tracking-widest text-4xl">Stay on Track with DIU Daily!</p>
      </div>
      <div class="w-full sm:w-1/2">
        <img src="src/img/cover2.jpg" alt="AWE.SOME header">
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

      function toggleButtonsVisibility() {
        if (window.innerWidth <= 768) {
          btnContainer2.style.display = "none";
          btnContainer.style.display = "block";


        } else {

          btnContainer.style.display = "none";
        }
      }
      toggleButtonsVisibility();
      window.addEventListener("resize", toggleButtonsVisibility);
    </script>
  </div>
</body>

</html>