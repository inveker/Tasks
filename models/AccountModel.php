<?php

class AccountModel
{

    public static function login() {
        if(isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $hash = DB::run("SELECT password FROM users WHERE username=?", $username)->fetch();
            $hash = $hash['password'];
            if(password_verify($password, $hash)) {
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
            if(preg_match("/[^a-z0-9]/i", $username) || //Проверка на недопустимые символы
               preg_match("/[^a-z0-9]/i", $password)) {
                   throw new Exception("Login and password can contain only A-z or 0-9");
            } elseif(strlen($username) >= 4 && strlen($password) >= 4){ //Проверка на длину
                try {
                    $password = password_hash($password, PASSWORD_DEFAULT);
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