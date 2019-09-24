<?php

class Router
{
    public static function run() {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $arr = explode('/', $uri);
        $controller = ucfirst(array_shift($arr));
        $action = array_shift($arr);
        call_user_func_array(array($controller, $action), $arr);
    }
}