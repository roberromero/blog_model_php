<?php
namespace Core;
use Core\Middleware\Middleware;
// use Core\Response;

class Router
{
      protected $routes = [];
      public function route($uri, $method){
        foreach($this->routes as $route){
              if($uri === $route['uri'] && strtoupper($method) === $route['method']){
                // if($route['middleware']){//if route is not null, note that it is initiated as null line 30
                //   $middleware = Middleware::MAP[$route['middleware']];
                //   (new $middleware)->handle();
                // }
                Middleware::resolve($route['middleware']);
                return require base_path("Http/controllers/{$route['controller']}");
              }
          }
      }
      public function only($key){
        $this->routes[array_key_last($this->routes)]['middleware'] = $key; //Find the last object and add the middelware that is null by default
        return $this;
      }
      public function add($uri, $controller, $method){
        //Really important two brakets in front of routes[] to add the routes in the array
        $this->routes[] = [
          'uri' => $uri,
          'controller' => $controller,
          'method' => $method,
          'middleware' => null
        ];
        return $this;
      }
      public function get($uri, $controller){
        return $this->add($uri, $controller, 'GET');
      }
      public function post($uri, $controller){
        return $this->add($uri, $controller, 'POST');
      }
      public function delete($uri, $controller){
        return $this->add($uri, $controller, 'DELETE');
      }
      public function patch($uri, $controller){
        return $this->add($uri, $controller, 'PATCH');
      }
      public function put($uri, $controller){
        return $this->add($uri, $controller, 'PUT');
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







