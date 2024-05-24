<?php

use Core\Response;
use Core\Database;
use Core\App;
use Core\Session;
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


function redirect($uri){
  header("Location: {$uri}");
  die();
}

function old($key, $default = '')
{
    return Core\Session::get('old')[$key] ?? $default;
}

function formatTimeStamp($timestamp)
{
    return htmlspecialchars((new DateTime($timestamp))->format('d/m/Y'));
}

function getImageProfile()
{
  $database = App::getContainer()->resolve(Database::class);
  $result = $database->query('SELECT avatar FROM users WHERE email = :email', [
    'email'=> Session::get('email')['username']
    ])->find();
  return URL_PATH . 'images/' . $result['avatar'];
}

function isUserLoggedIn($key) 
{
  return Session::get($key);
}

function sessionDetails($ref,$key){
  return Session::get($ref)[$key];
}