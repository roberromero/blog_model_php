<?php

use Core\App;
use Core\Database;
use Core\Session;

// use Core\Database;

//Instead of creating a new instance in each file, class App and Container have been created
// $config = require base_path('config.php');
// $database = new Database($config['database']);

// 'Core\Database' = Database::class = gives the full path
//$database is an instance of the class Database
$database = App::getContainer()->resolve(Database::class);

$username = Session::get('user')['username'];
$sql= $sql = '
SELECT posts.*, users.username 
FROM posts 
JOIN users ON posts.user_id = users.id 
WHERE posts.id = :id
';
$post = $database->query($sql, [
    'id' => $_POST['id']
    ])->findOrFail();
    
authorize($post['username'] === $username);

$post = $database->query('DELETE FROM posts WHERE id= :id', [
    'id' => $_POST['id']
]);

header("Location: /posts");
die();





