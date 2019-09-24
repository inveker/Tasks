<?php

class TaskModel
{
    public static function getPreviews() {
        $previews =  DB::run("SELECT id, description, author FROM tasks")->fetchAll();
        foreach ($previews as $preview) {
            yield $preview;
        }
    }

    public static function getTask($id) {
        $task = DB::run("SELECT * FROM tasks WHERE id=?", $id)->fetch();
        return $task;
    }
}