<?php
$router->get('/', 'index.php');
$router->get('/contact', 'contact.php');
$router->get('/about', 'about.php');

$router->get('/posts', 'posts/index.php');
$router->get('/posts/create', 'posts/create.php')->only('auth');
$router->post('/posts/store', 'posts/store.php')->only('auth');
$router->get('/post', 'posts/show.php')->only('auth');
$router->delete('/post/destroy', 'posts/destroy.php')->only('auth');
$router->get('/post/edit', 'posts/edit.php')->only('auth');
$router->patch('/post/update', 'posts/update.php')->only('auth');

$router->get('/register/index', 'register/index.php')->only('guest');
$router->post('/register/create', 'register/create.php')->only('guest');

$router->get('/login', 'sessions/login.php')->only('guest');
$router->post('/sessions', 'sessions/store.php')->only('guest');
$router->delete('/logout', 'sessions/logout.php')->only('auth');
