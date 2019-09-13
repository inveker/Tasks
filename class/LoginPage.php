<?php

require_once 'Page.php';
class LoginPage extends Page
{
    protected function content() {
        $msg = '';

        if(isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sth = DB::run("SELECT * FROM users WHERE username=? AND password=?", $username, $password)->fetch();
            if($sth) {
                //Авторизируем пользователя
                //Перенапраляем его на страницу main
                //Завершаем работу скрипта
                $_SESSION['auth'] = $username;
                header('Location: ?page=main');
                exit();
            }
            else {
                //Неверные данные
                $msg = 'AuthFail';
            }
        }?>

        <form method="POST">
        Логин <input name="username" type="text" required><br>
        Пароль <input name="password" type="password" required><br>
        <input type="submit" name="login" value="Войти">
        <b><?= $msg ?></b>
        </form>
        <?php
    }
}