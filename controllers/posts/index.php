<?php 
$config = require('config.php');

$heading = "My Notes";

//Creating an instance using "Database class" and using variables stored in Database.php
$database = new Database($config['database']);

$sql = "SELECT * FROM posts";
$posts = $database->query($sql)->all();

require('views/posts/index.view.php');
