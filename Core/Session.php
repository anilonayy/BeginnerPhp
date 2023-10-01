<?php

namespace Core;

class Session
{
    public const FLASH_KEY = "__flashed";
    public static function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    public static function has($key)
    {
        return (bool) static::get($key);
    }
    public static function get($key, $default = null)
    {
        return $_SESSION[static::FLASH_KEY][$key] ?? $_SESSION[$key] ?? $default;
    }

    public static function flash($key, $value)
    {
        $_SESSION[static::FLASH_KEY][$key] = $value;
    }

    public static function unFlash()
    {
        unset($_SESSION[static::FLASH_KEY]);
    }

    public static function flush()
    {
        $_SESSION = [];
    }

    public static function destroy()
    {
        session_destroy();

        $params = session_get_cookie_params();
        setcookie("PHPSESSID", "", time() - 12, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}
