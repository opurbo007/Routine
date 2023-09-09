<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "routine";

$connection = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $query = "SELECT teacher_id, name, password FROM teachers WHERE mail = ?";
  $stmt = $connection->prepare($query);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $teacher = $result->fetch_assoc();

  if ($teacher && $password === $teacher["password"]) {
    // Password is correct (plain text match). Log in the user.
    $_SESSION["teacher_id"] = $teacher["teacher_id"];
    header("Location: dashboard.php");
    exit();
  } else {
    // Invalid email or password. Display an error message.
    $loginError = "Invalid email or password. Please try again.";
  }
}

$connection->close();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Teacher Login</title>
</head>

<body>

  <h1>Teacher Login</h1>

  <?php if (isset($loginError)): ?>
    <p>
      <?php echo $loginError; ?>
    </p>
  <?php endif; ?>

  <form method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>

    <input type="submit" value="Login">
  </form>

</body>

</html>