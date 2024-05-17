<?php 
use Core\Database;
use Core\Session;

$config = require base_path('config.php');


$id = $_GET['id'];//GET method takes the paramether passed in the url ?id=x
$database = new Database($config['database']);

$username = (new Session())->get('user')['username'];

//Creating an instance using "Database class" and using variables stored in Database.php
$sql = "SELECT * FROM posts where id= :id";
$post = $database->query($sql, ['id' => $id])->findOrFail();
dd($post);
authorize($post['username'] === $username );
view('views/posts/show.view.php', [
    'heading' => 'POST',
    'post' => $post
]);




