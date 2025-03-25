<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to dashboard if already logged in
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the To-Do List App</title>
</head>
<body>
    <h2>Welcome to the To-Do List Application</h2>
    <p>If you don't have an account, please <a href="signup.php">sign up</a>.</p>
    <p>If you already have an account, please <a href="login.php">login</a>.</p>
</body>
</html>
