<?php 
namespace Core;

class Container
{

    protected $bindings = [];
    //bind= add
    public function bind($key, $resolver){
        $this->bindings[$key] = $resolver;
    }
    //resolve = remove
    public function resolve($key){
        if(!array_key_exists($key, $this->bindings)){
            throw new \Exception("No matching binding for {$key}");
        }
        $resolver = $this->bindings[$key];
        //the following function calls the funct in $resolver
        //and returns the result (the instance in this case)
        return call_user_func($resolver);
    }


}
