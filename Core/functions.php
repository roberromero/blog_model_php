<?php

use Core\Response;

//It shows and stops execution
function dd($value){
  echo "<pre>";
    var_dump($value);
  echo "</pre>";
  die();
}


//if value (the route) is equal to current URI, it returns true or false 
function urlIs($value){
  return $_SERVER["REQUEST_URI"] === $value;
}

//authorise the user to see a post
function authorize($condition, $status = Response::FORBIDDEN){
  if(!$condition){
    abort($status);
  }
}

//Returns the base path
function base_path($path){
  
  return BASE_PATH . $path;

}


function view($path, $attributes= []){

  //extract — Import variables into the current symbol table from an array
  //it helps the variables to be accessible in the view
  extract($attributes);

  //requires the view using the base path
  require base_path($path);

}


function abort($statusCode = Response::NOT_FOUND){
    global $routes;
    http_response_code($statusCode);
    view('views/'.$statusCode.'.php');
    die();
}

function login($params){
  $_SESSION['user'] = [
    'username' => $params['username'],
    'email' => $params['email']
];
  session_regenerate_id(true);
}

function logout(){
  $_SESSION = []; // this is also valid = $_SESSION = array();
  session_destroy();

  $params = session_get_cookie_params();
  setcookie('PHPSESSID', '', time() - 3600, $params['path'],$params['domain'], $params['secure'], $params['httponly']);
}

function redirect($uri){
  header("Location: {$uri}");
  die();
}