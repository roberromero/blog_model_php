<?php

use Core\App;
use Core\Validator;
use Core\Database;

$config = require base_path('config.php');
$database = App::getContainer()->resolve(Database::class);
$currentUserId = 1;

$post = $database->query('SELECT * FROM posts WHERE id=:id', [
    'id' => $_POST['id']
])->findOrFail();
authorize($post['user_id'] ===  $currentUserId);
$errors = [];

//Validation lines
if(!Validator::string($_POST['title'], 1, 25)){
    $errors['title'] = 'Please ensure the title is not empty and contains more than 25 characters.';
}
if(!Validator::string($_POST['description'], 0, 500)){
    $errors['description'] = 'Please ensure the description contains less than 500 characters.';
}

//check if errors
if(!empty($errors)){
   return view('views/posts/edit.view.php', [
            'errors' => $errors,
            'heading' => 'Edit',
            'post' => $post
        ]);
}
$database->query('UPDATE posts SET title=:title,description=:description WHERE id=:id', [
    'title' => $_POST['title'],
    'description' => $_POST['description'],
    'id'=> $_POST['id']
]);

header("Location: /posts");
die();

