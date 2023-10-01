<?php

use Core\Database;

$currentUserId = $_SESSION['user']['id'];

$config = require base_path('config.php');
$db = new Database($config['database']);


$note = $db->query('SELECT * FROM notes WHERE id = :id',[
        ':id' => $_GET['id']
])->fetchOrAbort();

authorize($currentUserId === $note['user_id']);


view("notes/show.view.php", [
    'heading' => 'Note',
    'note' => $note
]);