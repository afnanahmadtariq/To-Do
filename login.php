<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Find user by username in MongoDB
    $user = $usersCollection->findOne(['username' => $username]);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = (string) $user['_id'];
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        $_SESSION['error'] = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($_SESSION['error'])) { echo "<p style='color:red'>" . $_SESSION['error'] . "</p>"; unset($_SESSION['error']); } ?>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
    <a href="signup.php">Don't have an account? Signup</a>
</body>
</html>
