<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task = $_POST['task'];

    // Insert task into MongoDB
    $tasksCollection->insertOne([
        'user_id' => new MongoDB\BSON\ObjectId($user_id),
        'task' => $task,
        'completed' => false
    ]);
}

$tasks = $tasksCollection->find(['user_id' => new MongoDB\BSON\ObjectId($user_id)]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <a href="logout.php">Logout</a>

    <h3>Tasks</h3>
    <form method="POST" action="">
        <input type="text" name="task" placeholder="Enter task" required><br>
        <button type="submit">Add Task</button>
    </form>

    <ul>
        <?php foreach ($tasks as $task): ?>
            <li><?php echo $task['task']; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
