<?php
session_start();

function isUserAuthenticated()
{
  return isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] === true && $_SESSION["user_role"] === "teacher";
}

if (!isUserAuthenticated()) {

  header("Location: ../../login/logout.php");
  exit();
}