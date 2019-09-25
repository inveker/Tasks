<?php

class Router
{
    public static function run() {
        $uri = self::prepare($_SERVER['REQUEST_URI']);
        if(empty($uri[0])) {
            $controller = DEFAULT_CONTROLLER;
            $action = DEFAULT_ACTION;
            $args = [];
        } else {
            $controller = ucfirst($uri[0]).'Controller';
            $action = $uri[1].'Action';
            $args = array_slice($uri, 2);
        }

        if(class_exists($controller) && method_exists($controller, $action))
            call_user_func_array(array($controller, $action), $args);
        else
            call_user_func(array('MainController', 'page404Action'), $controller, $action);
    }

    protected static function prepare($uri) {
        $result = trim($uri, '/');
        $result = strtolower($result);
        $result = explode('/', $result);
        return $result;
    }
} 