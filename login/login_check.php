<?php
session_start();

function isUserAuthenticated()
{
  return isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] === true;
}

if (!isUserAuthenticated()) {
  header("Location: index.php");
  exit();
}
?>

<!-- <?php
if (isUserAuthenticated()) {
  // Your existing page content goes here
} else {
  echo "Access denied. Please log in.";
}
?>
<?php
include("path/to/login_check.php");
?> -->