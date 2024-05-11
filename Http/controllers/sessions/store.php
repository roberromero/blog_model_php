<?php 

use Core\Authenticator;
use Http\Forms\LoginForm;

$emailOrUsername = $_POST['emailOrUsername'];
$password = $_POST['password'];
$isErrorForm = true;

$form = new LoginForm();
if($form->validate($emailOrUsername, $password)){//if it returns true, continues
    $auth = new Authenticator();
    $auth->attempt($emailOrUsername, $password);

    if(empty($auth->getErrors())){
    $auth->login();
    redirect('/');
    }
    $isErrorForm = false;
}
return view('views/sessions/login.view.php', [
    'errors' => $isErrorForm ? $form->getErrors() : $auth->getErrors()
]);
