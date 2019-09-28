<?php

class AccountModel
{

    public static function login() {
        if(isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $hash = DB::run("SELECT password FROM users WHERE username=?", $username)->fetch();
            if(password_verify($password, $hash['password'])) {
                $_SESSION['auth'] = $username;
                return true;
            } else {
                throw new Exception("Incorrect login or password");
            }
        }
    }

    public static function register() {
        if(isset($_POST['username']) && isset($_POST['password'])
            && isset($_POST['captcha']) && isset($_SESSION['captcha']))
            {
                if($_POST['captcha'] != $_SESSION['captcha']) { //Проверка каптчи
                    throw new Exception("Captcha failed");
                }
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
                        if($e->getCode() == 22001) {
                            throw new Exception("Allowed size: username - 20, password - 20 characters");
                            }
                        throw new Exception("This user already exists");
                    }
                } else {
                    throw new Exception("Login and password length must be at least 4");
                }
            }
    }
}