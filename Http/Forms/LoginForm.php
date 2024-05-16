<?php 
namespace Http\Forms;
use Core\Validator;
use Core\ValidationException;

class LoginForm
{
    protected $errors = [];
    //(public array $attibutes) is a variable accesible in the class, it can be done out of the contruct but from Laravel 8 it can be typed in the argument
    public function __construct(public array $attributes)
    {
        if(!Validator::string($attributes['password'], 3, 255)){
            $this->errors['password'] = 'Password needs to be longer than 3 charaters long.';
        }
        if(!Validator::string($attributes['emailOrUsername'], 3, 255)){
            $this->errors['emailOrUsername'] = 'Email or username must be longer than 3 characters long.';
        }
    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);

        return $instance->hasErrors() ? $instance->throw() : $instance;
    }
    public function throw()
    {
        ValidationException::throw($this->getErrors(), $this->attributes);
    }

    public function hasErrors()
    {
        return count($this->errors);
    }
    public function getErrors()
    {
        return $this->errors;
    }
    public function addErrors($error)
    {
        $this->errors = $error;
        return $this;
    }
}