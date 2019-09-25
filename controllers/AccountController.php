<?php

class AccountController
{
    //Событие регистрации
    //Может рендерить 4 различных
    //Варианта страниц:
    //1) После создания нового аккаунта
    //2) С формой регистрации
    //3) С формой регистрации и сообщением об ошибке
    //4) С сообщение об ошибке, для уже авторизированных пользователей
    public static function loginAction() {
        $view = new NormalView('Login');
        //Если пользователь еще не авторизирован
        if($_SESSION['auth'] === null) {
            //Обрабатываем POST заспрос
            $result = AccountModel::login();
            //Если найдено совпадение login/password
            //Добавляем сообщение с приветствием и сразу же рендерим
            //После чего скрипт завершается, предотвращая дальнейший вывод
            if($result === true)
                $view->addElement('message', "Welcome {$_SESSION['auth']}")->render();
            //Добавляем контент страницы Login
            $view->addElement('login');
            //Если совпадений не было найдено
            //Добавляем сообщение об ошибке
            if($result === false) 
                $view->addElement('error', 'Incorrect login or password');
        } else
            //Если пользователь уже авторизирован, добавляем сообщение с ошибкой
            $view->addElement('error', 'You are login');
        //Рендерим страницу
        $view->render();
    }

    //Событие регистрации
    //Может рендерить 4 различных
    //Варианта страниц:
    //1) После создания нового аккаунта
    //2) С формой регистрации
    //3) С формой регистрации и сообщением об ошибке
    //4) С сообщение об ошибке, для уже авторизированных пользователей
    public static function registerAction() {
        $view = new NormalView('Register');
        //Если пользователь еще не авторизирован
        if($_SESSION['auth'] === null) {
            //Обрабатываем POST запрос
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
            $view->addElement('error', 'You are login');
        }
        $view->render();
    }

    public static function logoutAction() {
        AccountModel::logout();
        header('Location: /account/login');
        exit();
    }
}