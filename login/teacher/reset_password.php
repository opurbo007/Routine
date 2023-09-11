<?php
session_start();
include("../../database/config.php");

$token = $_GET["token"];


$sql = "SELECT `teacher_id`, `mail`, `password`, `token`, `expiry` FROM teachers WHERE `token`=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token);
$stmt->execute();

// Bind the result columns to variables
$stmt->bind_result($id, $email, $password, $token, $expiry);

// Fetch the result
if ($stmt->fetch()) {
  $user = array(
    'teacher_id' => $id,
    'mail' => $email,
    'password' => $password,
    'token' => $token,
    'expiry' => $expiry
  );
} else {

  die("Token Not Found");
}

if (strtotime($user["expiry"]) <= time()) {
  die("Link Expired");
}


?>



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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>Reset Password</title>
</head>

<body>

  <div class="flex flex-col min-h-screen w-full bg-gray-100 ">

    <div class="min-h-screen py-6 flex flex-col justify-center sm:py-12">
      <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div
          class="absolute inset-0 bg-gradient-to-r from-blue-300 to-green-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
        </div>
        <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
          <div class="max-w-md mx-auto">
            <div>
              <h1 class="text-2xl font-semibold px-16">
                New Password (teacher)

              </h1>
            </div>
            <form method="get" action="update_password.php" id="reset-password-form"
              onsubmit="return validatePassword()">


              <input type="hidden" name="token" value="<?php echo htmlspecialchars($token) ?>">

              <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                <div class="relative">
                  <input autocomplete="off" id="password" name="password" type="password"
                    class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600"
                    placeholder="Password" />


                  <label for="password"
                    class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
                    New Password
                  </label>
                </div>
                <div class="relative">
                  <input autocomplete="off" id="confirm_password" name="confirm_password" type="password"
                    class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600"
                    placeholder="Confirm Password" />

                  <label for="Confirm_password"
                    class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
                    Confirm New Password
                  </label>
                </div>

                <div class="relative">
                  <button class="bg-gradient-to-r from-green-300 to-blue-600 text-white rounded-md px-2 py-1"
                    type="submit" value="Login" name="admin_login">
                    <input type="submit" value="login" name="teacher_login" />
                  </button>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function validatePassword() {
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirm_password").value;

      if (password !== confirmPassword) {
        alert("Passwords do not match. Please try again.");
        return false;
      }

      return true;
    }
  </script>

</body>



</html>