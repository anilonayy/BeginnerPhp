<?php

namespace Core\Middleware;

use Core\Middleware\Auth;
use Core\Middleware\Guest;

class Middleware
{
    const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class
    ];    

    public static function resolve($key) 
    { 
        if(array_key_exists($key, self::MAP)) {
            $middleware  = self::MAP[$key];
            (new $middleware)->handle();
        }
       
    }
}