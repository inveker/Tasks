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

if(isset($_POST['username']) && $_POST['password'])
{
    // Вытаскиваем из БД запись, у которой логин равняеться введенному
    $query = DB::run("SELECT password FROM users WHERE username=? LIMIT 1", $_POST['username']);
    $data = $query->fetch(PDO::FETCH_ASSOC);
    // Сравниваем пароли
    if($data['password'] === $_POST['password'])
    {
        // Переадресовываем браузер на страницу проверки нашего скрипта
        header('location:index.php'); 
        $_SESSION['auth'] = true;
    }
    else
    {
        print "Вы ввели неправильный логин/пароль";
    }
}
