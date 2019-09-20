<?php

class Account extends Controller
{
    public static function register() {
        if($_SESSION['auth'] !== null) {
            header("Location: /account/index"); 
            exit();
        }
        $message = '';
        if(isset($_POST['username']) && isset($_POST['password'])) {
            if(AccountModel::register($_POST['username'], $_POST['password'])) {
                self::header('Welcome!');
                echo 'Account "', $_POST['username'], '" created';
                self::footer();
                exit();
            } else $message = 'This user has already exists';
        }
        self::header('Register');
        View::render('register_form', ['message' => $message]);
        self::footer();
    }

    public static function login() {
        if($_SESSION['auth'] !== null) {
            header("Location: /account/index"); 
            exit();
        }
        $message = '';
        if(isset($_POST['username']) && isset($_POST['password'])) {
            if(AccountModel::login($_POST['username'], $_POST['password']))
                header("Location: /account/index");
            else $message = 'Wrong login or password';
        }
        self::header('Login');
        View::render('login_form', ['message' => $message]);
        self::footer();
    }

    public function logout() {

    }
}