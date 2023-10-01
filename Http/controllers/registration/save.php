<?php

use Core\Validator;
use Core\App;
use Core\Database;

extract($_POST);

// validate form inputs
if(! Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if(!Validator::string($password,7,255)) {
    $errors['password'] = 'Please input a password between 7 and 255 characters.';
}


if(!empty($errors)) {
    view('registration/create.view.php',[
        'errors'=>$errors,
        'email' => $email,
    ]);
}



// check if the account already exists
    // If yes, redirtect to login.
    // If no , save it.
$db = App::resolve(Database::class);

$user = $db->query('SELECT * FROM users WHERE email=:email',[
    'email' => $email
])->fetch();


if($user) {
    header('location: /login');
    exit();
}


$db->query('INSERT INTO users(password,email) VALUES (:password,:email)',[
    'email'=> $email,
    'password'=> password_hash($password,PASSWORD_BCRYPT) 
]);

login([
    'email'=> $email
]);

header('location: /');
exit();