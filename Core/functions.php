<?php

use Core\Response;

function dd(mixed $value) {
    echo '<pre>';
    var_dump($value);
    echo '</pre>';

    die();
}

function getMenuClassByUri(string $uri) 
{
    return $_SERVER["REQUEST_URI"]=== $uri ?  "bg-gray-900 text-white" :  "text-gray-300 hover:bg-gray-700 hover:text-white";
};

function base_path($path) 
{
    return BASE_PATH.$path;
}

function view($path,$attributes = []) 
{
    extract($attributes);

    require_once base_path('views/'.$path);
}

function abort($statusCode = 404)  
{
    http_response_code($statusCode);
    require base_path("views/{$statusCode}.php");
    die();
 }

function authorize($bool) {
    $bool ? '' : abort(Response::FORBIDDEN);
}

function redirect(string $url) {
    header("location: $url");
    exit();
}

function old($key,$default = null)
{
    return Core\Session::get('old')[$key] ?? $default;
}