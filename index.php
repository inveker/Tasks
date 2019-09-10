<?php
session_start();
$name = $_SESSION['user'] ?? 'Guest';

require_once 'header.php';

echo 'Welcome ' . $name . '<br>'; 

require_once 'tasks.php';

require_once 'footer.php';