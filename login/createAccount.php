<?php
include("../database/config.php");

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Document</title>
</head>

<body>
  <div class="content-container">
    <div class="min-h-screen py-6 flex flex-col justify-center sm:py-12">
      <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div
          class="absolute inset-0 bg-gradient-to-r from-blue-300 to-green-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
        </div>
        <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
          <div class="max-w-md mx-auto">
            <div>
              <h1 class="text-2xl font-semibold px-12">
                Register Admin
              </h1>
            </div>
            <div class="divide-y divide-gray-200 mt-6">
              <form action="POST" action="insert.php">
                <div class="relative">
                  <input autocomplete="off" id="email" name="admin_email" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900
                  focus:outline-none focus:borer-rose-600" placeholder="Email address" />
                  <label for="adminemail"
                    class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
                    Email Address
                  </label>
                </div>
                <div class="relative">
                  <input autocomplete="off" id="password" name="password" type="password" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900
                      focus:outline-none focus:borer-rose-600" placeholder="Password" />
                  <label for="password"
                    class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
                    Password
                  </label>
                </div>
                <div class="relative">
                  <input autocomplete="off" id="password" name="password" type="password" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900
                      focus:outline-none focus:borer-rose-600" placeholder="Password" />
                  <label for="password"
                    class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
                    Confirm Password
                  </label>
                </div>
                <div class="relative">
                  <button class="bg-gradient-to-r from-green-600 to-blue-600 text-white rounded-md mt-4 px-2 py-1"
                    type="submit" value="Login">

                    <input type="submit" />
                  </button>
                </div>
            </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>

</html>