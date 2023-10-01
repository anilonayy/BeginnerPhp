<?php

use Core\App;
use Core\Database;
use Core\Validator;

$heading = "Note Edit";
$currentUserId = $_SESSION['user']['id'];

$db = App::resolve(Database::class);

$note = $db->query('SELECT * FROM notes WHERE id = :id',[
    'id' => $_POST['id']
])->fetch();
 
authorize($note['user_id'] === $currentUserId);


$body = $_POST['body'];
$errors = [];

if (!Validator::string($body)) {
    $errors['body'] = 'A body is required';
}

if (!Validator::string($body, 1, 100)) {
    $errors['body'] = 'Body text cannot be a greater than 100 character.';
}

if (empty($errors)) {
    $db->query('UPDATE notes SET body=:body WHERE id= :id ',[
        'id' => $_POST['id'],
        'body' => $body
    ]);

    header('location: /notes');

} else {
    view("notes/edit.view.php",[
        'heading' => $heading,
        'errors' => $errors,
        'note' => $note
    ]);    
}


