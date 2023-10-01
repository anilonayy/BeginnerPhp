<?php

use Core\Database;
use Core\Validator;

$heading = "Note Create";
$currentUserId = $_SESSION['user']['id'];


$config = require base_path('config.php');
$db = new Database($config['database']);

$errors = [];


$body = $_POST['body'];


$errors = [];

if (!Validator::string($body)) {
    $errors['body'] = 'A body is required';
}

if (!Validator::string($body, 1, 100)) {
    $errors['body'] = 'Body text cannot be a greater than 100 character.';
}

if (empty($errors)) {
    $db->query('INSERT INTO notes(body,user_id) VALUES(:body,:user_id)', [
        ':body' => $body,
        ':user_id' => $currentUserId
    ]);
} else {
    view("notes/create.view.php",[
        'heading' => 'Note Create',
        'errors' => $errors
    ]);
}

header('location: /notes');
