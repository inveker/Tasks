<?php

class Router
{
    private function __construct(){}
    private function __clone(){}

    public static function getController() {
        $nameController = ($_GET['url'] ?? 'Preview');
        require_once 'Controller.php';
        $controller = new Controller($nameController);
        return $controller;
    }
}