<?php

class AccountModel
{

    public static function login() {
        if(isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $query = DB::run("SELECT * FROM users WHERE username=? AND password=?",
                                                                $username, $password)->fetch();
            if($query) { //Если есть данные
                $_SESSION['auth'] = $username;
                return true;
            } else {
                throw new Exception("Incorrect login or password");
            }
        }
    }

    public static function register() {
        if(isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if(preg_match("/[^a-z0-9]/", $username) || //Проверка на недопустимые символы
               preg_match("/[^a-z0-9]/", $password)) {
                   throw new Exception("Login and password can contain only A-z or 0-9");
            } elseif(strlen($username) >= 4 && strlen($password) >= 4){ //Проверка на длину
                try {
                    DB::run("INSERT INTO users SET username=?, password=?",
                                                $username, $password);
                    return $username;
                } catch (PDOException $e){
                    throw new Exception("This user already exists");
                }
            } else {
                throw new Exception("Login and password length must be at least 4");
            }
        }
    }

    public static function logout() {
        unset($_SESSION['auth']);
    }
}