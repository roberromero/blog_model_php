<?php
namespace Core;
// use Core\Response;

class Router{
      public $routes = [];
      public function route($uri, $method){
        foreach($this->routes as $route){
              if($uri === $route['uri'] && strtoupper($method) === $route['method']){
                return require base_path($route['controller']);
              }
          }
      }
      public function add($uri, $controller, $method){
        //Really important two brakets in front of routes[] to add the routes in the array
        $this->routes[] = [
          'uri' => $uri,
          'controller' => $controller,
          'method' => $method
        ];
      }
      public function get($uri, $controller){
        $this->add($uri, $controller, 'GET');
      }
      public function post($uri, $controller){
        $this->add($uri, $controller, 'POST');
      }
      public function delete($uri, $controller){
        $this->add($uri, $controller, 'DELETE');
      }
      public function patch($uri, $controller){
        $this->add($uri, $controller, 'PATCH');
      }
      public function put($uri, $controller){
        $this->add($uri, $controller, 'PUT');
      }
      
}

// function routeToController($uri, $routes){
//   $controllers = array_keys($routes);
//   if(in_array($uri, $controllers)){
//     foreach($controllers as $controller){
//       if($uri === $controller){
//         require(base_path($routes[$controller]));
//       }
//     }
//   }else{
//     abort();
//   }
// }



// function abort($statusCode = Response::NOT_FOUND){
//     global $routes;
//     http_response_code($statusCode);
//     view('views/'.$statusCode.'.php');
//     die();
// }







