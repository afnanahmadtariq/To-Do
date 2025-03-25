<?php
session_start();
require 'vendor/autoload.php';
require 'config.php';

$message = '';

// Handle user signup
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $existingUser = $usersCollection->findOne(['email' => $email]);
    if (!$existingUser) {
        $usersCollection->insertOne(['email' => $email, 'password' => $password]);
        $message = 'Signup successful! Please login.';
    } else {
        $message = 'User already exists!';
    }
}

// Handle user login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = $usersCollection->findOne(['email' => $email]);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = (string)$user['_id'];
        header("Location: dashboard.php");
        exit();
    } else {
        $message = 'Invalid credentials!';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>To-Do List - Login/Signup</title>
</head>
<body>
  <?php if ($message): ?>
    <p><?php echo htmlspecialchars($message); ?></p>
  <?php endif; ?>

  <h2>Signup</h2>
  <form method="post">
    <input type="email" name="email" required placeholder="Email">
    <input type="password" name="password" required placeholder="Password">
    <button type="submit" name="signup">Sign Up</button>
  </form>

  <h2>Login</h2>
  <form method="post">
    <input type="email" name="email" required placeholder="Email">
    <input type="password" name="password" required placeholder="Password">
    <button type="submit" name="login">Login</button>
  </form>
</body>
</html>
