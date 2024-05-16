<?php
namespace Core;
use Core\App;
use Core\Database;
use Core\Session;

class Authenticator
{
    protected $errors = [];
    protected $user = [];
    
    public function attempt($emailOrUsername, $password){
        $database = App::getContainer()->resolve(Database::class);
        $result = $database->query('SELECT * FROM users WHERE email=:emailOrUsername OR username=:emailOrUsername', [
            'emailOrUsername' => $emailOrUsername
            ])->find();
        $this->user = $result;
        if(!$result){
            $this->errors['emailOrUsername'] = 'Email address or Username not valid.';
            return $this;
        }
        
        if(!password_verify($password, $result['password'])){
            $this->errors['password'] = 'Password not valid.';
            return $this;
        }
        self::login();
        return $this;
    }

    public function getErrors(){
        return $this->errors;
    }

    public function login(){
       // $_SESSION['user'] = [
        //  'username' => $this->user['username'],
       //   'email' => $this->user['email']
     // ];
        Session::put('user', ['username' => $this->user['username']]);
        Session::put('email', ['username' => $this->user['email']]);

        session_regenerate_id(true);
      }

      public static function logout(){
        Session::flush();
      }

}