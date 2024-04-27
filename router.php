<?php
//associative array in PHP
$routes = [
  '/' => '/blog_model_php/',
  '/index' => '/blog_model_php/index.php/index',
  '/contact' => '/blog_model_php/index.php/contact',
  '/about' => '/blog_model_php/index.php/about',
  '/posts'=> '/blog_model_php/index.php/posts',
  '/post'=> '/blog_model_php/index.php/post',
  '/posts-create'=>'/blog_model_php/index.php/posts-create'
];

//parse_url function to discard queries "?asas"
$uri = parse_url($_SERVER["REQUEST_URI"])['path'];

function routeToController($uri, $routes){
    $controllers = array_keys($routes);
    $exists = in_array($uri, $routes);
      if($exists){
        foreach($controllers as $path){
          if($uri === $routes[$path]){
            $path = ($path === '/') ? '/index' : $path;
            require('controllers'.$path.'.php');
          }
      }
      }else{
        abort();
      }
}

function abort($statusCode = Response::NOT_FOUND){
    global $routes;
    http_response_code($statusCode);
    require('views/'.$statusCode.'.php');
    die();
}

//Use the function
routeToController($uri, $routes);