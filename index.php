<?php
require_once 'core/DB.php';
require_once 'core/Router.php';
session_start();
$_SESSION['auth'] = $_SESSION['auth'] ?? '';

Router::getController()->run();