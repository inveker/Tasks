<?php
session_start();

echo <<<_HTML
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title>My Tasks</title>
</head>
<body>
    <header>
        <img src="img/logo.png" alt="logo">
    </header>
    <nav>
        <a href="index.php">Main</a>
_HTML;

if(!isset($_SESSION['auth'])) {
    echo <<<_HTML
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
_HTML;
} else {
    echo <<<_HTML
        <a href="addnewtask.php">New Task</a>
        <a href="exit.php">Выход</a>
_HTML;
}

echo '</nav>';

