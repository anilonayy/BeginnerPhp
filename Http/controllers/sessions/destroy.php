<?php

$_SESSION = [];

session_destroy();

$params = session_get_cookie_params();
setcookie("PHPSESSID","", time() - 12,$params['path'],$params['domain'],$params['secure'],$params['httponly']);

header('location: /');
exit();