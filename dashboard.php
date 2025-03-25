<?php
session_start();
require 'vendor/autoload.php';
require 'config.php';

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

$userId = new MongoDB\BSON\ObjectID($_SESSION['user']);

// Add a new task
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_task'])) {
    $task = trim($_POST['task']);
    if ($task !== '') {
        $tasksCollection->insertOne([
            'user_id' => $userId,
            'task'    => $task,
            'completed' => false
        ]);
    }
}

// Delete a task
if (isset($_GET['delete'])) {
    $taskId = $_GET['delete'];
    $tasksCollection->deleteOne([
        '_id' => new MongoDB\BSON\ObjectID($taskId),
        'user_id' => $userId
    ]);
}

// Retrieve user tasks
$tasks = $tasksCollection->find(['user_id' => $userId]);
?>
<!DOCTYPE html>
<html>
<head>
  <title>To-Do List Dashboard</title>
</head>
<body>
  <h2>Your To-Do List</h2>

  <form method="post">
    <input type="text" name="task" required placeholder="New task">
    <button type="submit" name="add_task">Add Task</button>
  </form>

  <ul>
    <?php foreach ($tasks as $task): ?>
      <li>
        <?php echo htmlspecialchars($task['task']); ?>
        <a href="dashboard.php?delete=<?php echo $task['_id']; ?>">Delete</a>
      </li>
    <?php endforeach; ?>
  </ul>

  <p><a href="logout.php">Logout</a></p>
</body>
</html>
