<?php

class AccountController extends NormalController
{
    public static function loginAction() {
        if($_SESSION['auth'] === null) { //Доступ только для не авторизированных пользователей
            $view = new NormalView('Login');
            try {
                $result = AccountModel::login();
                if($result === true) { //Warning: render() here
                    $view->addElement('message', "Welcome {$_SESSION['auth']}")->render();
                }
            } catch (Exception $e) {
                $view->addElement('error', $e->getMessage());
            }
            $view->addElement('login')->render();
        } else {
            throw new Exception("Not Permission");
        }
    }

    public static function registerAction() {
        if($_SESSION['auth'] === null) { //Доступ только для не авторизированных пользователей
            $view = new NormalView('Register');
            try {
                $result = AccountModel::register();
                if($result == true) { //Warning: render() here
                    $view->addElement('message', "You are created acconut [ $result ]")->render();
                }
            } catch (Exception $e) {
                $view->addElement('error', $e->getMessage());
            }
            $view->addElement('register')->render();
        } else {
            throw new Exception("Not Permission");
        }
    }

    public static function logoutAction() {
        unset($_SESSION['auth']);
        header('Location: /account/login');
        exit();
    }
}