<?php

use Core\App;
use Core\Database;
use Core\Session;

$config = require base_path('config.php');
$database = App::getContainer()->resolve(Database::class);

$username = Session::get('user')['username'];
$sql = 'SELECT posts.*, users.username 
FROM posts 
JOIN users ON posts.user_id = users.id 
WHERE posts.id = :id';
$post = $database->query($sql, [
                          'id' => $_GET['id']
                ])->findOrFail();

authorize($post['username'] === $username);

view('views/posts/edit.view.php', [
    'heading' => 'Edit',
    'post' => $post
]);
