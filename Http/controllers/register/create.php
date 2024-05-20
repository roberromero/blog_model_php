<?php
use Core\Authenticator;
use Http\Forms\RegisterForm;

//validate form
$form = RegisterForm::validate($attributes = [
    'username' => $_POST['username'],
    'email' => $_POST['email'],
    'profession' => $_POST['profession'],
    'avatar' => $_FILES['avatar'],
    'password' => $_POST['password']
]);
//add file
$form->addFile($_FILES['avatar']);
//creates user
$form->isUserCreated($_POST);
//sign in user
$authenticator = new Authenticator();
$authenticator->setUser([
    'username' => $_POST['username'],
    'email' => $_POST['email']
]);
$authenticator->login();
redirect('/');
 
    