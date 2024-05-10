<?php 
namespace Http\Forms;
use Core\Validator;

class LoginForm
{
    protected $errors = [];

    public function validate($password, $result)
    {
        $isValid = true;
        // dd($result);
        if(!Validator::string($password, 3, 255)){
            $this->errors['password'] = 'Password needs to be longer than 3 charaters.';
            $isValid = false;
        }
        if(!$result){
            $this->errors['emailOrUsername'] = 'Email address or Username not valid.';
            $isValid = false;
        }
        
        return $isValid;
    }

    public function getErrors(){
        return $this->errors;
    }
}