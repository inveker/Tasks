<?php

class AccountModel
{
    //Возвращаем 3 вида значений TRUE FALSE NULL
    //TRUE - когда пользовтель найден
    //FALSE - когда введены неверные данные
    //NULL - когда пост запрос не обрабатывается
    public static function login() {
        if(isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $query = DB::run("SELECT * FROM users WHERE username=? AND password=?",
                                                                $username, $password)->fetch();
            if($query) {
                $_SESSION['auth'] = $username;
                return true;
            }
            else return false;
        } return null;
    }

    //Возвращаем 3 вида значений TRUE FALSE NULL
    //TRUE - когда пользовтеля удалось зарегестрировать
    //FALSE - когда пользователя нельзя зарегестрировать
    //NULL - когда пост запрос не обрабатывается
    public static function register() {
        if(isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if(preg_match("/[a-z0-9]{4,}/i", $username) &&
               preg_match("/[a-z0-9]{4,}/i", $password)) {
                try {
                    DB::run("INSERT INTO users SET username=?, password=?",
                                                $username, $password);
                    return $username;
                } catch (PDOException $e) {
                    throw new Exception("This user already exists");
                }
            } else {
                throw new Exception("Login and password can contain only A-z or 0-9");
            }
        }
    }

    //Делает текущего пользователя не авторизированным
    public static function logout() {
        unset($_SESSION['auth']);
    }
}