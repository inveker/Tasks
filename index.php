<?php
session_start();
$name = $_SESSION['user'] ?? 'Guest';

require_once 'header.php';

echo 'Welcome ' . $name . '<br>'; 

echo "<div class='tasks'>";
require_once 'functions.php';
showPreviewTasks();
echo "</div>";

require_once 'footer.php';