<?php

use Core\App;
use Core\Database;

$heading = "Note Create";
$currentUserId = $_SESSION['user']['id'];

$db = App::resolve(Database::class);

$errors = [];

view("notes/create.view.php",[
    'heading' => 'Note Create',
    'errors' => $errors
]);
