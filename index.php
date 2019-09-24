<?php
require_once 'config.php';
require_once 'core/autoload.php';

session_start();
$_SESSION['auth'] = $_SESSION['auth'] ?? null;

Router::run();