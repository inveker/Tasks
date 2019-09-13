<?php

class Router
{
    private function __construct(){}
    private function __clone(){}

    public static function getPage() {
        $namePage = self::getNamePage();
        require_once "class/{$namePage}.php";
        return new $namePage();
    }

    private static function getNamePage() {
        if(isset($_GET['page'])) {
            $name = preg_replace("/\/*\.*\s*/", '', $_GET['page']);
            $name = strtolower($name);
            $name = ucfirst($name);
        } else $name = 'Main';
        $name = $name . 'Page';
        if(file_exists($name . '.php')) $name = 'MainPage';
        return $name;
    }
}