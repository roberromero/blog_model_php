<?php
namespace Core;

use function PHPUnit\Framework\isEmpty;

class Validator
{   

    public static function string($value, $min=1, $max=INF){

        $value = trim($value);
        return strlen($value) >= $min && strlen($value) <=$max;
    }
    
    public static function email($email){

        return filter_var($email, FILTER_VALIDATE_EMAIL);

    }
    public static function isEmailRegistered($email, $database){
        return $database->query('SELECT * FROM users WHERE email = :email',[
            'email' => $email
        ])->find();
    }
    public static function isUserRegistered($username, $database){
        return $database->query('SELECT * FROM users WHERE username = :username',[
            'username' => $username
        ])->find();
    }

    public static function doesFileExist($fileName){
        return !empty($fileName);
    }
    public static function isValidFormat($fileType){
        $fileType = strtolower(substr(strrchr($fileType, '/'), 1));
        $allowedTypes = ['png', 'jpeg', 'jpg'];
        return in_array($fileType, $allowedTypes);
    }
    public static function isSizePermitted($fileSize){
        return $fileSize < 400800;//200kb=204800
    }
}