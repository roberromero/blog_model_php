<?php 
require ('Validator.php');
$config = require('config.php');
$heading = "New Post"; 
$errors = [];
//Creating an instance using "Database class" and using variables stored in Database.php
/*$database = new Database($config['database']);

$sql = "SELECT * FROM posts";
$posts = $database->query($sql)->all();*/

if($_SERVER["REQUEST_METHOD"] === 'POST'){

    if(!Validator::string($_POST['title'], 1, 25)){
        $errors['title'] = 'Title cannot be more than 25 characters.';
    }

    }


require('views/posts-create.view.php');
