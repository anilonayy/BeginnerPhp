<?php
use Core\Session;

$heading =  'Login';

view('sessions/create.view.php',[
    'heading' => $heading,
    'errors' => Session::get('errors'),
]);