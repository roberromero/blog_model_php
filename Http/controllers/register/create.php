<?php
use Core\App;
use Core\Authenticator;
use Core\Database;
use Http\Forms\RegisterForm;

use function PHPUnit\Framework\isEmpty;

$database = App::getContainer()->resolve(Database::class);

//validate data email and password (correct format)
$form = RegisterForm::validate($attributes = [
    'username' => $_POST['username'],
    'email' => $_POST['email'],
    'profession' => $_POST['profession'],
    'password' => $_POST['password']
]);
if(!isEmpty($form)){
    $database->query('INSERT INTO users(username, admin, email, password) 
    VALUES (:username, 0,:email,:password)', [
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'password' => password_hash($_POST['password'], PASSWORD_BCRYPT)//PASSWORD_DEFAULT SHOULD GET BCRYPT BY DEFAULT
    ]);
}
$authenticator = new Authenticator();
$authenticator->setUser([
    'username' => $_POST['username'],
    'email' => $_POST['email']
]);
$authenticator->login();
//login
redirect('/');
 
    