<?php

class TaskModel
{
    public static function getTask($id) {
        $task = DB::run("SELECT * FROM tasks WHERE id=?", $id)->fetch();
        return $task;
    }

    public static function getPreviews() {
        $previews = DB::run("SELECT * FROM tasks")->fetchAll();
        foreach ($previews as $preview) {
            yield $preview;
        }
    }

    public static function updateTask($id) {
        DB::run("UPDATE tasks SET description=? code=? WHERE id=?",
                    $_POST['description'], $_POST['code'], $id);
    }
}