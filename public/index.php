<?php

use Core\Session;
use Core\ValidationException;

session_start();
$_SESSION['name'] = 'Anil';

const BASE_PATH = __DIR__.'/../';

require_once BASE_PATH.'Core/functions.php';


spl_autoload_register(function($class) {
    $class = str_replace('\\',DIRECTORY_SEPARATOR,$class); // Core\Database => Core/Database
    require base_path("$class.php");
});


require base_path("bootstrap.php");


$uri = parse_url($_SERVER["REQUEST_URI"])['path'];
$method =  $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router = new Core\Router();
require_once base_path('routes.php');

try {
    $router->route($uri,$method);
} catch (ValidationException $ex) {
    Session::flash('errors', $ex->errors());
    Session::flash('old', $ex->old());

    return redirect($router->previousUrl());
}

