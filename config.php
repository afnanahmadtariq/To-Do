<?php
require 'vendor/autoload.php';

$mongoUri = getenv('MONGO_URI') ?: 'mongodb://localhost:27017';
$mongoClient = new MongoDB\Client($mongoUri);
$database = $mongoClient->todo_app;
$usersCollection = $database->users;
$tasksCollection = $database->tasks;
