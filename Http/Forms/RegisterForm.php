<?php 
namespace Http\Forms;
use Core\App;
use Core\Database;
use Core\Validator;
use Core\ValidationException;

class RegisterForm
{
    protected $errors = [];
    //(public array $attibutes) is a variable accesible in the class, it can be done out of the contruct but from Laravel 8 it can be typed in the argument
    public function __construct(public array $attributes)
    {
        if(!Validator::string($attributes['username'], 3, 255)){
            $this->errors['username'] = 'Your username needs to be longer than 3 charaters.';
        }
        if(!Validator::string($attributes['password'], 3, 255)){
            $this->errors['password'] = 'Your password needs to be longer than 3 charaters.';
        }
        if(!Validator::email($attributes['email'])){
            $this->errors['email'] = 'A different email needs to be used.';
        }
        if(!Validator::string($attributes['profession'], 3, 255)){
            $this->errors['profession'] = 'Your profession needs to be longer than 3 charaters.';
        }
        // Get the database instance
        $database = App::getContainer()->resolve(Database::class);

        // Validate if email address already exists in the database
        if (Validator::isEmailRegistered($attributes['email'], $database)) {
            $this->errors['email'] = 'That email already exists in the database.';
        }

        // Validate if the username already exists in the database
        if (Validator::isUserRegistered($attributes['username'], $database)) {
            $this->errors['username'] = 'That username already exists in the database.';
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
    public function getAttributes()
    {
        return $this->attributes;
    }
}