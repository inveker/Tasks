<?php
session_start(); //Начинаем работу с сессией на всех страницах
$_SESSION['auth'] = $_SESSION['auth'] ?? null;
?>

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
        <br>
        <nav>
            <a href="?page=main">Main</a>
            <?php if(empty($_SESSION['auth'])) : ?>
            <a href="?page=register">Register</a>
            <a href="?page=login">Login</a>
            <?php else : ?>
            <a href="?page=newtask">New Task</a>
            <a href="?page=exit">Выход</a>
            <?php endif; ?>
        </nav>
    </header>
    <main>