<?php
$router->get('/', 'controllers/index.php');
$router->get('/contact', 'controllers/contact.php');
$router->get('/about', 'controllers/about.php');

$router->get('/posts', 'controllers/posts/index.php');
$router->get('/posts/create', 'controllers/posts/create.php');
$router->post('/posts/store', 'controllers/posts/store.php');

$router->get('/post', 'controllers/posts/show.php');
$router->delete('/post/destroy', 'controllers/posts/destroy.php');
$router->get('/post/edit', 'controllers/posts/edit.php');
$router->patch('/post/update', 'controllers/posts/update.php');

$router->get('/register/index', 'controllers/register/index.php');
$router->post('/register/index/submit', 'controllers/register/index-submit.php');
$router->get('/register/login', 'controllers/register/login.php');
