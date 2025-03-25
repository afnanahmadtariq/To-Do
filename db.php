<?php
// Load the environment variables from a .env file
require_once 'vendor/autoload.php';

// Retrieve MongoDB URI from the environment variable
$mongoUri = getenv('MONGO_URI'); // Ensure that MONGO_URI is set in your environment or .env file

// Connect to MongoDB
$client = new MongoDB\Client($mongoUri);

// Select the database and collections
$db = $client->todo_app; // This is the database name
$usersCollection = $db->users;
$tasksCollection = $db->tasks;
?>
