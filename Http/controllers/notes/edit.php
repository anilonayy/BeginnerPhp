<?php

use Core\App;
use Core\Database;

$heading = "Note Edit";
$currentUserId = $_SESSION['user']['id'];


$db = App::resolve(Database::class);

$note = $db->query('SELECT * FROM notes WHERE id = :id',[
    'id' => $_GET['id']
])->fetch();

authorize($currentUserId === $note['user_id']);

view("notes/edit.view.php",[
    'heading' => $heading,
    'note' => $note
]);
