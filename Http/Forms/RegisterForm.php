<?php 
namespace Http\Forms;
use Core\App;
use Core\Database;
use Core\Validator;
use Core\ValidationException;

class RegisterForm
{
    protected $errors = [];
    protected $database;
    protected $fileFullName;
    //(public array $attibutes) is a variable accesible in the class, it can be done out of the contruct but from Laravel 8 it can be typed in the argument
    public function __construct(public array $attributes)
    {   $this->database = App::getContainer()->resolve(Database::class);

        if(!Validator::string($attributes['username'], 3, 255)){
            $this->errors['username'] = 'Your username needs to be longer than 3 charaters.';
        }
        if(!Validator::string($attributes['password'], 3, 255)){
            $this->errors['password'] = 'Your password needs to be longer than 3 charaters.';
        }
        if(!Validator::email($attributes['email'])){
            $this->errors['email'] = 'A different email needs to be used.';
        }
        if(!Validator::string($attributes['profession'], 3, 255)){
            $this->errors['profession'] = 'Your profession needs to be longer than 3 charaters.';
        }

        // Validate if email address already exists in the database
        if (Validator::isEmailRegistered($attributes['email'], $this->database)) {
            $this->errors['email'] = 'That email already exists in the database.';
        }

        // Validate if the username already exists in the database
        if (Validator::isUserRegistered($attributes['username'], $this->database)) {
            $this->errors['username'] = 'That username already exists in the database.';
        }
        if(!Validator::doesFileExist($attributes['avatar']['name'])){
            $this->errors['avatar'] = 'The avatar is compulsory.';
        }
        if(!Validator::isValidFormat($attributes['avatar']['type'])){
            $this->errors['avatar'] = 'The format is not valid (only jpge, jpg and png formats).';
        }
        if(!Validator::isSizePermitted($attributes['avatar']['size'])){
            $this->errors['avatar'] = 'A maximum of 400KB File Size supported.';
        }
        
    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);
        return $instance->hasErrors() ? $instance->throw() : $instance;
    }
    public function throw()
    {
        ValidationException::throw($this->getErrors(), $this->attributes);
    }

    public function hasErrors()
    {
        return count($this->errors);
    }
    public function getErrors()
    {
        return $this->errors;
    }
    public function addErrors($error)
    {
        $this->errors = $error;
        return $this;
    }
    public function getAttributes()
    {
        return $this->attributes;
    }

    public function addFile($file){
        $targetDir = base_path('public/images/');
        $fileName = time() . '_' . uniqid();
        $fileExtension = strtolower(substr(strrchr($file['type'], '/'), 1));
        $targetFile  = $targetDir . $fileName . "." . $fileExtension;
        $this->fileFullName = $fileName . "." . $fileExtension;
        if(!move_uploaded_file($file["tmp_name"], $targetFile)){
            $this->addErrors([
                'avatar' => 'File could not be created. Error occured.'
            ]);
            $this->throw();
        }
    
    }

    public function isUserCreated($form){
        $isCreated = $this->database->query('INSERT INTO users(username, admin, email, password, profession, avatar) 
                                VALUES (:username, 0,:email,:password, :profession, :avatar)', [
                                    'username' => $form['username'],
                                    'email' => $form['email'],
                                    'password' => password_hash($form['password'], PASSWORD_BCRYPT),//PASSWORD_DEFAULT SHOULD GET BCRYPT BY DEFAULT
                                    'profession' => $form['profession'],
                                    'avatar' => $this->fileFullName
        ]);
        if(!$isCreated){
            $this->addErrors([
                'avatar' => 'Error occured when inserting in the database.'
            ]);
            $this->throw();
        }
    }
}