<?php

use Core\App;
use Core\Database;

$db =  App::container()->resolve('Core\Database');

$currentUserId = $_SESSION['user']['id'];

$note = $db->query('SELECT * FROM notes WHERE id = :id',[
    ':id' => $_POST['id']
])->fetchOrAbort();

authorize($currentUserId === $note['user_id']);

$db->query('DELETE FROM notes WHERE id = :id',[
    'id' => $_POST['id']
]);

header('');


header('location: /notes');
exit();