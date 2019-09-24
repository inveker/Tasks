<?php
require_once 'config.php';
require_once 'core/autoload.php';

session_start();
$_SESSION['auth'] = $_SESSION['auth'] ?? null;

$view = new NormalView();
for($i = 0; $i < 20; $i++) {
    $view->addElement("preview", 'hierh');
}
$view->render();