<?php

class Router
{
    private function __construct(){}
    private function __clone(){}

    public static function getController() {
        $nameController = ($_GET['url'] ?? 'Preview') . 'Controller';
        $path = __DIR__.'/../Controllers/' . $nameController . '.php';
        if(file_exists($path)) {
            require_once $path;
            return new $nameController();
        } else {
            header("HTTP/1.0 404 Not Found");
            exit();
        }
    }
}