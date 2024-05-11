<?php 
namespace Http\Forms;
use Core\Validator;

class LoginForm
{
    protected $errors = [];

    public function validate($emailOrUsername,$password)
    {
        $isValid = true;
        if(!Validator::string($password, 3, 255)){
            $this->errors['password'] = 'Password needs to be longer than 3 charaters long.';
            $isValid = false;
        }
        if(!Validator::string($emailOrUsername, 3, 255)){
            $this->errors['emailOrUsername'] = 'Email or username must be longer than 3 characters long.';
            return false;
        }
        return $isValid;        ;
    }

    public function getErrors(){
        return $this->errors;
    }
}