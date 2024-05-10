<?php

namespace Http\Forms;
use Core\Validator;


class NewPostForm
{
    protected $errors = [];

    public function validate($title, $description){
        if(!Validator::string($title, 1, 25)){
            $this->errors['title'] = 'Please ensure the title is not empty and contains more than 25 characters.';
        }
        if(!Validator::string($description, 0, 500)){
            $this->errors['description'] = 'Please ensure the description contains less than 500 characters.';
        }
        if(empty($this->errors)){
            return true;
         }
         return false;
    }

    public function getErrors(){
        return $this->errors;
    }
}