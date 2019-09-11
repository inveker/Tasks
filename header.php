<?php
session_start();
$user = $_SESSION['user'] ?? 'Guest';
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
        <?= "Welcome $user" ?>
        <nav>
            <a href="index.php">Main</a>
            <?php if(!isset($_SESSION['user'])) : ?>
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
            <?php else : ?>
            <a href="newtask.php">New Task</a>
            <a href="exit.php">Выход</a>
            <?php endif; ?>
        </nav>
    </header>

