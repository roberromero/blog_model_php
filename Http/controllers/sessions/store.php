<?php 
use Core\App;
use Core\Database;
use Http\Forms\LoginForm;

$emailOrUsername = $_POST['emailOrUsername'];
$password = $_POST['password'];

$database = App::getContainer()->resolve(Database::class);
$result = $database->query('SELECT * FROM users WHERE email=:emailOrUsername OR username=:emailOrUsername', [
    'emailOrUsername' => $emailOrUsername
    ])->find();

$form = new LoginForm();
if(!$form->validate($password, $result)){//redirect with error if it returns false
    return view('views/sessions/login.view.php', [
        'errors' => $form->getErrors()
    ]);
}

//I need creating Authorization class**////////////////////
if(!password_verify($password, $result['password'])){
    $errors['password'] = 'Password not valid.';
}
login($result);
redirect('/');
//***/////////////////////// */