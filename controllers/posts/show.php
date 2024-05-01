<?php 
use Core\Database;
$config = require base_path('config.php');


$id = $_GET['id'];//GET method takes the paramether passed in the url ?id=x
$database = new Database($config['database']);

$currentUser = 1;

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $sql = "SELECT * FROM posts where id= :id";
    $post = $database->query($sql, ['id' => $id])->findOrFail();
    authorize($post['user_id'] === $currentUser);
    $post = $database->query('DELETE FROM posts WHERE id= :id', [
        'id' => $_GET['id']
    ]);
    
    header("Location: /posts");
    exit();

}else{
    
    //Creating an instance using "Database class" and using variables stored in Database.php
    $sql = "SELECT * FROM posts where id= :id";
    $post = $database->query($sql, ['id' => $id])->findOrFail();
    authorize($post['user_id'] === $currentUser);
    view('views/posts/show.view.php', [
      'heading' => 'POST',
      'post' => $post,
      'routes' => $routes
    ]);
};




