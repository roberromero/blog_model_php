<?php
$router->get('/', 'controllers/index.php');
$router->get('/contact', 'controllers/contact.php');
$router->get('/about', 'controllers/about.php');
$router->get('/posts', 'controllers/posts/index.php');
$router->get('/post', 'controllers/posts/show.php');
$router->get('/posts/create', 'controllers/posts/create.php');
$router->post('/posts/store', 'controllers/posts/store.php');