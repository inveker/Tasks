<?php
//Подключаем автозагрузчик классов
require_once 'core/autoloader.php';
//Начинаем работу с сессией
session_start();
$_SESSION['auth'] = $_SESSION['auth'] ?? '';
//Создаем массив пустей, допустимых для передачи
//в $_GET['url'], затем регистрируем его в роутере
$urls = ['Preview', 'Register', 'Login', 'Task', 'Newtask'];
Router::setPath($urls);
//Роутер определяет контроллер, после чего заускает
//его метод run()
Router::getController()->run();