<?php

$q = DB::run("SELECT * FROM tasks")->fetchAll();
foreach ($q as $v) {
    require_once 'view/Task.php';
    $task = new Task($v);
    $task->preview();
}