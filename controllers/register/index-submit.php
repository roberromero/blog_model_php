<?php
use Core\Validator;
use Core\App;
use Core\Database;
$database = App::getContainer()->resolve(Database::class);

$errors = [];
//validate data email and password (correct format)
if(!Validator::string($_POST['username'], 3, 255)){
    $errors['username'] = 'Your username needs to be longer than 3 charaters.';
}
if(!Validator::string($_POST['password'], 3, 255)){
    $errors['password'] = 'Your password needs to be longer than 3 charaters.';
}
if(!Validator::email($_POST['email'])){
    $errors['email'] = 'A different email needs to be used.';
}
//validate if email address already exists in the database
$result = $database->query('SELECT COUNT(*) AS email_count FROM users WHERE email = :email',[
    'email' => $_POST['email']
])->findOrFail();
if($result['email_count']){
    $errors['email'] = 'That email already exists in the database.';
}
//validate if the username already exists in the database
$result = $database->query('SELECT COUNT(*) AS username_count FROM users WHERE username = :username',[
    'username' => $_POST['username']
])->findOrFail();
if($result['username_count']){
    $errors['username'] = 'That username already exists in the database.';
}

if(!empty($errors)){
    return view('views/register/index.view.php', [
             'errors' => $errors
         ]);
 }else{
    $database->query('INSERT INTO users(admin, email, password) 
                        VALUES (0,:email,:password)', [
                            'email' => $_POST['email'],
                            'password' => $_POST['password']
                        ]);
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['loggedin'] = true;
    
    header("Location: /");
 }
    