<?php 
$config = require('config.php');

//Creating an instance using "Database class" and using variables stored in Database.php
$database = new Database($config['database']);

$id = $_GET['id'];
$sql = "SELECT * FROM posts where id= :id";
$post = $database->query($sql, ['id' => $id])->findOrFail();

/*if(!$post){
abort(Response::NOT_FOUND);//No need to add "not_found" const because it uses it by default 
}*///No needed because I created findOrFail function that covers it
$currentUser = 1;

if($post['user_id'] !== $currentUser){
  abort(Response::FORBIDDEN);
}
$heading = "POST";

require('views/post.view.php');
