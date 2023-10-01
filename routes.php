<?php 

$router->get('/','index.php');
$router->get('/about','about.php');
$router->get('/contact','contact.php');

$router->get('/notes','notes/index.php')->only('auth');
$router->delete('/notes','notes/destroy.php');
$router->get('/notes/create','notes/create.php');
$router->post('/notes','notes/save.php');
$router->get('/note','notes/show.php');
$router->get('/note/edit','notes/edit.php');
$router->patch('/note/edit','notes/update.php');


$router->delete('/notes','notes/destroy.php');

$router->get('/register','registration/create.php')->only('guest');
$router->post('/register','registration/save.php')->only('guest');

$router->get('/login','sessions/create.php')->only('guest');
$router->post('/login','sessions/save.php')->only('guest'); 
$router->delete('/logout','sessions/destroy.php')->only('auth'); 