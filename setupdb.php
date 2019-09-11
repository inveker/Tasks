<?php
require_once 'DB.php';

$query = DB::run("SHOW TABLES FROM task");
if (!$query->fetchAll()) {
    DB::run("CREATE TABLE users (
                username VARCHAR(15) PRIMARY KEY,
                password VARCHAR(30),
                email VARCHAR(30))");

    DB::run("CREATE TABLE tasks (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                description VARCHAR(128),
                code VARCHAR(10000),
                creater VARCHAR(15))");

    DB::run("CREATE TABLE comments (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                comment VARCHAR(100),
                creater VARCHAR(15))");

    echo "Tables created";
} else
    echo "Tables exist";

