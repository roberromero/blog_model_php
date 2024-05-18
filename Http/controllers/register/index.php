<?php
use Core\Session;

 view('views/register/index.view.php',[
    'errors' => Session::get('errors') ?? []
 ]);