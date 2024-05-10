<?php 

namespace Core\Middleware;

use Core\Middleware\Auth;
use Core\Middleware\Guest;

class Middleware
{
    const MAP = [
        'auth' => Auth::class,
        'guest' => Guest::class
    ];

    public static function resolve($arg){
        if(!$arg){//if route is not null, note that it is initiated as null line 30
            return;
        }
        $middleware = static::MAP[$arg];
        if(!$middleware){//if null
            throw new \Exception("No matching middleware found in --{$arg}--");
        }
        // $middleware printed for instance could be equal to "Core\Middleware\Auth" in a string
        //PHP allows you to instantiate classes dynamically by their name.
        (new $middleware)->handle();
    }
    
    
}
