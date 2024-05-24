<?php 
use Http\Forms\NewPostForm;
use Core\Database;
use Core\App;
use Core\Session;
$title = $_POST['title'];
$description = $_POST['description'];
$database = App::getContainer()->resolve(Database::class);

$form = new NewPostForm();
//if false return errors
if(!$form->validate($title, $description)){
 $errors = $form->getErrors();
       return view('views/posts/create.view.php', [
            'errors' => $errors,
            'heading' => 'New Post'
        ]);
}
//"Database::class" is equivalent to the string 'Core\Database'
$database2 = App::getContainer()->resolve(Database::class);
$sql = 'SELECT id FROM users WHERE username= :username';
$userId = $database2->query($sql, ['username'=> Session::get('user')['username']])->find();
//coalescing operator to simplify the extraction of user_id from the array
$userId = $userId['id'] ?? null;

$result = $database->query('INSERT INTO posts(title, description, user_id) VALUES (:title, :description, :user_id)', [
    'title' => htmlspecialchars($title),
    'description' => htmlspecialchars($description),
    'user_id' => $userId
]);

redirect('/posts');


