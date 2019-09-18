<?php

class Controller
{
    private static $path = [];

    private function __construct(){}
    private function __clone(){}

    public static function connect() {
        $name = self::parse();
        if(in_array($name, self::$path)) {
            self::run($name);
        } else {
            $not = new ErrorView(['msg' => "Not found controller $name"]);
        }
    }

    public static function register($paths) {
        self::$path = array_merge(self::$path, $paths);
    }

    private static function run($name) {
        $M = $name.'Model';
        $V = $name.'View';
        $model = new $M();
        $view = new $V($model->getData());
    }

    private static function parse() {
        $name = $_GET['url'] ?? 'Preview';
        return ucfirst(strtolower($name));
    }
}