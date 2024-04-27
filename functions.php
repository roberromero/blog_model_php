<?php

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

