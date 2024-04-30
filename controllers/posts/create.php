<?php 
require ('Validator.php');
$config = require('config.php');
$heading = "New Post"; 
$errors = [];


if($_SERVER["REQUEST_METHOD"] === 'POST'){

    //Validation lines
    if(!Validator::string($_POST['title'], 1, 25)){
        $errors['title'] = 'Please ensure the title is not empty and contains more than 25 characters.';
    }
    if(!Validator::string($_POST['description'], 0, 500)){
        $errors['description'] = 'Please ensure the description contains less than 500 characters.';
    }

    //check if errors
    if(empty($errors)){
        echo "No errors";
        //user_id needs changing since it has been harcoded
        $database = new Database($config['database']);
        $database->query('INSERT INTO posts(title, description, user_id) VALUES (:title, :description, 1)', [
            'title' => $_POST['title'],
            'description' => $_POST['description']
        ]);

        header("Location: {$routes['/posts']}");
        die();
    }

    }
    

require('views/posts/create.view.php');