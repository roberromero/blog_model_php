<?php
use Core\Session;

 view('views/sessions/login.view.php',[
    'errors' => Session::get('errors') ?? []
 ]);