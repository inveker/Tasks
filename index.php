<?php

require_once 'core/config.php';
require_once 'core/autoload.php';
// require_once 'install_tabbles.php';

date_default_timezone_set('Europe/Moscow');

session_start();
$_SESSION['auth'] = $_SESSION['auth'] ?? null;

Router::run();