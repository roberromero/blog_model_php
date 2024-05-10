<?php 
use Core\Database;

$config = require base_path('config.php');
//Creating an instance using "Database class" and using variables stored in Database.php
$database = new Database($config['database']);

$sql = "SELECT * FROM posts";
$posts = $database->query($sql)->all();

view('views/posts/index.view.php', [
  'posts' => $posts,
  'heading' => 'My Notes'
]);
