<?php

use Core\Response;

$routes = require(base_path('routes.php'));

//parse_url function to discard queries "?asas"
$uri = parse_url($_SERVER["REQUEST_URI"])['path'];

function routeToController($uri, $routes){
  $controllers = array_keys($routes);
  if(in_array($uri, $controllers)){
    foreach($routes as $route){
      if($uri === $route){
        require(base_path('controllers'.$route.'.php'));
      }
    }
  }else{
    abort();
  }
}

//Use the function
routeToController($uri, $routes);

function abort($statusCode = Response::NOT_FOUND){
    global $routes;
    http_response_code($statusCode);
    view('views/'.$statusCode.'.php');
    die();
}
