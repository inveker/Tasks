<?php
require_once 'DB.php';
require_once 'Page.php';

class MainPage extends Page
{
    protected function content() {
        $q = DB::run("SELECT * FROM tasks")->fetchAll();
        foreach ($q as $v) {
            require_once 'Task.php';
            $task = new Task($v);
            $task->preview();
        }
    }
}