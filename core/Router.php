<?php

class Router
{
    public static function run() {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $arr = explode('/', $uri);
        $controller = ucfirst(array_shift($arr));
        $action = array_shift($arr);
        if(class_exists($controller) && method_exists($controller, $action))
            call_user_func_array(array($controller, $action), $arr);
        else
            call_user_func(array('Main', 'page404'));
    }
}