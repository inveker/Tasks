<?php

class AccountController
{

    public static function loginAction() {
        $view = new NormalView('Login');

        if($_SESSION['auth'] === null) {
            try {
                $result = AccountModel::login();
                if($result === true) {
                    $view->addElement('message', "Welcome {$_SESSION['auth']}")->render();
                }
            } catch (Exception $e) {
                $view->addElement('error', $e->getMessage());
            }
            $view->addElement('login');
        } else {
            $view->addElement('error', 'You are already logged in');
        }
        $view->render();
    }

    public static function registerAction() {
        $view = new NormalView('Register');
        if($_SESSION['auth'] === null) {
            try {
                $result = AccountModel::register();
                if($result == true) {
                    $view->addElement('message', "You are created acconut [ $result ]")->render();
                }
            } catch (Exception $e) {
                $view->addElement('error', $e->getMessage());
            }
            $view->addElement('register');
        } else {
            $view->addElement('error', 'You are already logged in');
        }
        $view->render();
    }

    public static function logoutAction() {
        AccountModel::logout();
        header('Location: /account/login');
        exit();
    }
}