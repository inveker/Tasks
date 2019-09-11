<?php 
require_once 'DB.php';

if(isset($_SESSION['auth'])) {
    header("Location: index.php");
}

require_once 'header.php';


echo <<<_HTML
<form method="POST">
Логин <input name="username" type="text" required><br>
Пароль <input name="password" type="password" required><br>
<input type="submit" value="Зарегистрироваться">
</form>
_HTML;

require_once 'footer.php';


if(isset($_POST['username']) && $_POST['password']) {

    $err = [];

    $query = DB::run("SELECT username FROM users WHERE username=?", $_POST['username']);
    if($query->fetch())
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }

    if(count($err) == 0)
    {

        $login = $_POST['username'];

        // Убераем лишние пробелы и делаем двойное хеширование
        $password = $_POST['password'];

        DB::run("INSERT INTO users SET username=?, password=?", $login, $password);
        $_SESSION['username'] = $_POST['username'];
        echo "<p>Вы зарегестрированны</p>";
    }
    else
    {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err as $error)
        {
            print $error."<br>";
        }
    }
}