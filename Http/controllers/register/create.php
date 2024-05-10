<?php
use Core\Validator;
use Core\App;
use Core\Database;
$database = App::getContainer()->resolve(Database::class);

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$errors = [];

//validate data email and password (correct format)
if(!Validator::string($username, 3, 255)){
    $errors['username'] = 'Your username needs to be longer than 3 charaters.';
}
if(!Validator::string($password, 3, 255)){
    $errors['password'] = 'Your password needs to be longer than 3 charaters.';
}
if(!Validator::email($email)){
    $errors['email'] = 'A different email needs to be used.';
}
//validate if email address already exists in the database
$result = $database->query('SELECT * FROM users WHERE email = :email',[
    'email' => $email
])->find();
if($result){
    $errors['email'] = 'That email already exists in the database.';
}
//validate if the username already exists in the database
$result = $database->query('SELECT * FROM users WHERE username = :username',[
    'username' => $username
])->find();
if($result){
    $errors['username'] = 'That username already exists in the database.';
}

if(!empty($errors)){
    return view('views/register/index.view.php', [
             'errors' => $errors
         ]);
 }else{
    $database->query('INSERT INTO users(username, admin, email, password) 
                        VALUES (:username, 0,:email,:password)', [
                            'username' => $username,
                            'email' => $email,
                            'password' => password_hash($password, PASSWORD_BCRYPT)//PASSWORD_DEFAULT SHOULD GET BCRYPT BY DEFAULT
                        ]);
    //it defines $_SESSION['user']
    login([
        'username' => $username,
        'email' => $email
    ]);
   
    header("Location: /");
    exit();
 }
    