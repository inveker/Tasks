<?php

class Router
{
    public static function run() {
        $uri        = self::prepare($_SERVER['REQUEST_URI']);
        $controller = empty($uri[0]) ? DEFAULT_CONTROLLER : ucfirst($uri[0]);
        $action     = empty($uri[1]) ? DEFAULT_ACTION : $uri[1];
        $args       = array_slice($uri, 2);
        call_user_func_array(array($controller, $action), $args);
    }

    protected static function prepare($uri) {
        $result = trim($uri, '/');
        $result = strtolower($result);
        $result = explode('/', $result);
        return $result;
    }
}