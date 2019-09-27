<?php

try {


    DB::run("CREATE TABLE tasks (
                                 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                 description VARCHAR(500) NOT NULL,
                                 code VARCHAR(5000) NOT NULL,
                                 author VARCHAR(20) NOT NULL,
                                 date DATETIME NOT NULL
                                 )");

    DB::run("CREATE TABLE comments (
                                    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    comment VARCHAR(500) NOT NULL,
                                    author VARCHAR(20) NOT NULL,
                                    task INT UNSIGNED NOT NULL,
                                    date DATETIME NOT NULL
                                    )");

    DB::run("CREATE TABLE users (
                                 username VARCHAR(20) NOT NULL PRIMARY KEY ,
                                 password VARCHAR(255) NOT NULL
                                 )");

    echo "Install tables complited";
} catch (PDOException $e) {
    echo "Install tables failed. This tables has exists:";
    $q = DB::run("SHOW TABLES")->fetchAll();
    foreach ($q as $tabble) {
        echo '<br>';
        print_r($tabble);
    }
}
exit();