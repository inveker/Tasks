<?php

spl_autoload_register(function ($class) {
    foreach (PATH as $path) {
        $path .= "$class.php";
        if(file_exists($path)) {
            require_once $path;
            break;
        }
    }
});