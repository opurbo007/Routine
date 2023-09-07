<?php
session_start();


session_unset();


session_destroy();

// Redirect to the login page (change the path accordingly)
header("Location: ../../index.php");
exit();
?>