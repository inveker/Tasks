<?php
session_start();
require_once 'DB.php';

if(isset($_SESSION['auth'])) {
    header("Location: index.php");
}

require_once 'header.php';

echo <<<_HTML
<form method="POST">
Логин <input name="username" type="text" required><br>
Пароль <input name="password" type="password" required><br>
<input type="submit" value="Войти">
</form>
_HTML;

require_once 'footer.php';

if(isset($_POST['username']) && $_POST['password']) {
    $query = DB::run("SELECT password FROM users WHERE username=?", $_POST['username']);
    $data = $query->fetch(PDO::FETCH_ASSOC);
    if($data['password'] === $_POST['password']) {
        $_SESSION['auth'] = true;
        $_SESSION['name'] = $_POST['username'];
        header('Location:index.php'); 
    } else {
        print "Вы ввели неправильный логин/пароль";
    }
}
