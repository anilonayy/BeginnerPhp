<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

extract($_POST);


$form = LoginForm::validate([
    'email' => $email,
    'password'=> $password
]);


$signedIn = (new Authenticator)->attempt($email, $password);

// if the user can not login
if(!$signedIn) {
    $form->error('message', 'No matching account found for this email address and password')->throw(); 
}

redirect('/');