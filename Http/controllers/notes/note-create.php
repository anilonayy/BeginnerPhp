<?php

use Core\Database;
use Core\Validator;

require './Validator.php';

$heading = "Note Create";


$body = $_POST['body'];
$currentUserId = $_SESSION['user']['id'];


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
}

view("notes/note-create.view.php",[
    'heading' => $heading,
    'errors' => $errors,
]);