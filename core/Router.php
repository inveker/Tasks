<?php

class Router
{
    private static $path = [];

    private function __construct(){}
    private function __clone(){}

    public static function getController() {
        $nameController = self::normalize($_GET['url'] ?? 'Preview');
        if(in_array($nameController, self::$path)) {
            $controller = new Controller($nameController);
            return $controller;
        } else {
            header("HTTP/1.0 404 Not Found");
            exit();
        }
    }

    public static function setPath($paths) {
        self::$path = array_merge(self::$path, $paths);
    }

    private static function normalize($str) {
        return ucfirst(strtolower($str));
    }
}