<?php 
use Core\Validator;
use Core\Database;

$config = require base_path('config.php');
$database = new Database($config['database']);

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
   return view('views/posts/create.view.php', [
            'errors' => $errors,
            'heading' => 'New Post'
        ]);
}
$database->query('INSERT INTO posts(title, description, user_id) VALUES (:title, :description, 1)', [
    'title' => $_POST['title'],
    'description' => $_POST['description']
]);

header("Location: /posts");
die();

