<?php

spl_autoload_register(function ($class) {
    @include_once "$class.php";
});
spl_autoload_register(function ($class) {
    @include_once __DIR__."/../Models/$class.php";
});
spl_autoload_register(function ($class) {
    @include_once __DIR__."/../Views/$class.php";
});
spl_autoload_register(function ($class) {
    die("Not found $class");
});