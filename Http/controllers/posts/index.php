<?php 
use Core\Database;

$config = require base_path('config.php');
//Creating an instance using "Database class" and using variables stored in Database.php
$database = new Database($config['database']);

//$sql = "SELECT * FROM posts";
$sql = "SELECT posts.*, 
               users.username, 
               users.profession,
               users.avatar
        FROM posts
        INNER JOIN users ON posts.user_id = users.id;";
$posts = $database->query($sql)->all();
view('views/posts/index.view.php', [
  'posts' => $posts,
  'heading' => 'Posts'
]);
