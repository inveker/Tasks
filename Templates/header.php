<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title><?=$title?></title>
</head>
<body>
    <header>
        <img src="img/logo.png" alt="logo">
        <br>
        <nav>
            <a href="?page=main">Main</a>
            <?php if(empty($_SESSION['auth'])) : ?>
            <a href="?url=Register">Register</a>
            <a href="?url=Login">Login</a>
            <?php else : ?>
            <a href="?url=newtask">New Task</a>
            <a href="?url=exit">Выход</a>
            <?php endif; ?>
        </nav>
    </header>
    <main>