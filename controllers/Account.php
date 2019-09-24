<?php

class Account
{
    public static function login() {
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

    public static function register() {
        $view = new NormalView('Register');
        //Если пользователь еще не авторизирован
        if($_SESSION['auth'] === null) {
            //Обрабатываем POST запрос
            $result = AccountModel::register();
            //Если пользователя удалось зарегестрировать
            //В переменной $result храниться имя пользователя
            //Которое добавляется в сообщении об успешной регистрации
            //После чего рендерится страница и скрипт завершается
            if($result == true)
                $view->addElement('message', "You are created acconut [ $result ]")->render();
            //Добавляем контент страницы Register
            $view->addElement('register');
            //Если пользователь уже существует в базе
            //Добавляем сообщение об ошибке
            if($result === false) 
                $view->addElement('error', 'This user has already exists');
        } else
            //Если пользователь уже авторизирован, добавляем сообщение с ошибкой
            $view->addElement('error', 'You are login');
        $view->render();
    }

    public static function logout() {
        AccountModel::logout();
        header('Location: /account/login');
        exit();
    }
}