<?php 
use Core\Database;
$config = require base_path('config.php');

$database = new Database($config['database']);
$currentUser = 1;

$sql = "SELECT * FROM posts where id= :id";
$post = $database->query($sql, ['id' => $_POST['id']])->findOrFail();
authorize($post['user_id'] === $currentUser);
$post = $database->query('DELETE FROM posts WHERE id= :id', [
    'id' => $_POST['id']
]);

header("Location: /posts");
die();





