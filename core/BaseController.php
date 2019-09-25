<?php

class BaseController
{
    protected static function exeptionHandler($e) {
        echo $e->getMessage();
        exit();
    }


    public static function __callStatic($name, $arguments) {
        try {
            static::$name(...$arguments);
        } catch (Exception $e) {
            static::exeptionHandler($e);
        }
    }
}