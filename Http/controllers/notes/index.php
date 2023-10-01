<?php

use Core\App;
use Core\Database;

$db =  App::container()->resolve(Database::class);

$currentUserId = $_SESSION['user']['id'];


$notes = $db->query('SELECT * FROM notes WHERE user_id =:id',[
    'id' => $currentUserId
])->fetchAll();

view("notes/index.view.php",[
    'heading' => 'My Notes',
    'notes' => $notes
]);