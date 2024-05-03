<?php

use Core\App;
use Core\Database;

// use Core\Database;

//Instead of creating a new instance in each file, class App and Container have been created
// $config = require base_path('config.php');
// $database = new Database($config['database']);

// 'Core\Database' = Database::class = gives the full path
//$database is an instance of the class Database
$database = App::getContainer()->resolve(Database::class);

$currentUser = 1;

$post = $database->query("SELECT * FROM posts where id= :id", [
    'id' => $_POST['id']
    ])->findOrFail();
    
authorize($post['user_id'] === $currentUser);

$post = $database->query('DELETE FROM posts WHERE id= :id', [
    'id' => $_POST['id']
]);

header("Location: /posts");
die();





