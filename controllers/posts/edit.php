<?php

use Core\App;
use Core\Database;

$currentUserId = 1;

$config = require base_path('config.php');
$database = App::getContainer()->resolve(Database::class);
$post = $database->query('SELECT * FROM posts WHERE id=:id', [
    'id' => $_GET['id']
])->findOrFail();
authorize($post['user_id'] ===  $currentUserId);

view('views/posts/edit.view.php', [
    'heading' => 'Edit',
    'post' => $post
]);
