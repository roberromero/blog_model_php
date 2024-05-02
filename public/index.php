<?php 
//__DIR__ finds the current directory and /../ goes up a level which is the root of the project
const BASE_PATH = __DIR__ . '/../';
require(BASE_PATH . 'Core/functions.php');
require (base_path('Core/Database.php'));
require(base_path('Core/Response.php'));
require(base_path('Core/Validator.php'));
require(base_path('Core/Router.php'));

$router = new \Core\Router();
$routes = require(base_path('routes.php'));
// //parse_url function to discard queries "?asas"
$uri = parse_url($_SERVER["REQUEST_URI"])['path'];
//if the request method is coming from a value (in this case from a form) 
//initiate the variable if not the request method from server.
$requestMethod = $_POST['_request_method'] ?? $_SERVER['REQUEST_METHOD'];
$router->route($uri, $requestMethod);










// This function is not working, it should read all classes called in the project.
// spl_autoload_register(function($class){ 
//   dd($class);
// });