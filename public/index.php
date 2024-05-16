<?php 
//__DIR__ finds the current directory and /../ goes up a level which is the root of the project

use Core\Session;
use Core\ValidationException;

const BASE_PATH = __DIR__ . '/../';
require(BASE_PATH . 'Core/functions.php');
//5-17 I had this code that was substituted by the following:
// Register Autoloader
spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require base_path("{$class}.php");
});
require(base_path('bootstrap.php'));
session_start();
$router = new \Core\Router();
//$router instance is accessible so "routes.php" can generate the routes using the instance $router
require(base_path('routes.php'));
//parse_url function to discard queries "?asas"
$uri = parse_url($_SERVER["REQUEST_URI"])['path'];
//if the request method is coming from a value (in this case from a form) 
//initiate the variable, if not the request method from server that can only be POST or GET
$requestMethod = $_POST['_request_method'] ?? $_SERVER['REQUEST_METHOD'];

try{

    $router->route($uri, $requestMethod);

}catch(ValidationException $exception){
    Session::flash('errors', $exception->errors());
    Session::flash('old', $exception->oldFormData());
    redirect($router->previousUrl());
}

//clean the errors
Session::unflash();



// require (base_path('Core/Database.php'));
// require(base_path('Core/Response.php'));
// require(base_path('Core/Validator.php'));
// require(base_path('Core/Router.php'));
// require(base_path('Core/Container.php'));
// require(base_path('Core/App.php'));
// require(base_path('bootstrap.php'));
// require (base_path('Core/Middleware/Middleware.php'));
// require (base_path('Core/Middleware/Auth.php'));
// require (base_path('Core/Middleware/Guest.php'));
// require (base_path('Http/Forms/NewPostForm.php'));
// require (base_path('Http/Forms/LoginForm.php'));
// require(base_path('Core/Authenticator.php'));