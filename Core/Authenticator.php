<?php
namespace Core;
use Core\App;
use Core\Database;

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
            return false;
        }
        
        if(!password_verify($password, $result['password'])){
            $this->errors['password'] = 'Password not valid.';
            return false;
        }
        return true;
    }

    public function getErrors(){
        return $this->errors;
    }

    public function login(){
        $_SESSION['user'] = [
          'username' => $this->user['username'],
          'email' => $this->user['email']
      ];
        session_regenerate_id(true);
      }

      public static function logout(){
        $_SESSION = []; // this is also valid = $_SESSION = array();
        session_destroy();
      
        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'],$params['domain'], $params['secure'], $params['httponly']);
      }

}