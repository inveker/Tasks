<?php
//Подключаем автозагрузчик классов
require_once 'core/autoloader.php';
//Начинаем работу с сессией
session_start();
$_SESSION['auth'] = $_SESSION['auth'] ?? '';

$urls = ['Preview', 'Register', 'Login', 'Task', 'Newtask'];
Controller::register($urls);
Controller::connect();