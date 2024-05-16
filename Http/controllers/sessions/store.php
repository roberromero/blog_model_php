<?php 

use Core\Authenticator;
use Http\Forms\LoginForm;

$form = LoginForm::validate($attributes = [
    'emailOrUsername' => $_POST['emailOrUsername'], 
    'password' => $_POST['password']
]);

$signedIn = (new Authenticator)->attempt($attributes['emailOrUsername'], $attributes['password'])->getErrors();

if($signedIn){
    $form->addErrors($signedIn)->throw();
}
redirect('/');







//There was an issue that needed fixing using Post/Redirect/Get (PRG) pattern ------***

/*return view('views/sessions/login.view.php', [
    'errors' => $isErrorForm ? $form->getErrors() : $auth->getErrors()
]);*/

//$_SESSION['_flash']['errors'] = $isErrorForm ? $form->getErrors() : $auth->getErrors();