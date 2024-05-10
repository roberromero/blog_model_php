<?php 
use Http\Forms\NewPostForm;
use Core\Database;
use Core\App;

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
$database->query('INSERT INTO posts(title, description, user_id) VALUES (:title, :description, 1)', [
    'title' => htmlspecialchars($title),
    'description' => htmlspecialchars($description)
]);
redirect('/posts');


