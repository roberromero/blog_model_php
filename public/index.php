<?php 
//__DIR__ finds the current directory and /../ goes up a level which is the root of the project
const BASE_PATH = __DIR__ . '/../';
require(BASE_PATH . 'Core/functions.php');
require (base_path('Core/Database.php'));
require(base_path('Core/Response.php'));
require(base_path('Core/Validator.php'));
require(base_path('Core/router.php'));

// This function is not working, it should read all classes called in the project.
// spl_autoload_register(function($class){ 
//   dd($class);
// });