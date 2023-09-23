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

  
    .changing-text {
      animation: fadeInOut 3s ease-in-out infinite;
    }

 
       
    body {
      /* background-image: url('src/img/cover2.jpg');  */
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-color: rgba(0, 0, 0, 0.5);
    }

    nav {
      background-color: rgba(128, 0, 128, 0.8); 
    }
  </style>
</head>

<body class="bg-gray-100">
<nav class="bg-gray-900 p-4">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-gray-200 text-2xl font-bold">DIU DAILY</h1>
      <ul class="space-x-4">
        <li class="inline-block">
          <a class="text-gray-200 hover:text-gray-200" href="src/student/select.php">Student</a>
        </li>
        <li class="inline-block">
          <a class="text-gray-200 hover:text-gray-200" href="login/admin/login.php">Admin</a>
        </li>
        <li class="inline-block">
          <a class="text-gray-200 hover:text-gray-200" href="login/teacher/login.php">Teacher</a>
        </li>
      </ul>
    </div>
  </nav>


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

   
    </script>
  </div>
</body>

</html>