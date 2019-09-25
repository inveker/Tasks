<?php

class TaskModel
{
    public static function getPreviews() {
        $previews =  DB::run("SELECT id, description, author FROM tasks")->fetchAll();
        $previews = array_reverse($previews);
        foreach ($previews as $preview) {
            yield $preview;
        }
    }

    public static function getTask($id) {
        $task = DB::run("SELECT * FROM tasks WHERE id=?", $id)->fetch();
        return $task;
    }

    public static function updateTask($id) {
        if(isset($_POST['description']) && isset($_POST['code'])) {
            DB::run("UPDATE tasks SET description=?, code=? WHERE id=?",
                        $_POST['description'], $_POST['code'], $id);
            return true;
        }
    }

    public static function addNewTask() {
        if(isset($_POST['description']) && isset($_POST['code'])) {
            $q = DB::run("INSERT INTO tasks SET description=?, code=?, author=?",
                        $_POST['description'], $_POST['code'], $_SESSION['auth']);
            return DB::lastInsertId();
        }
    }

    public static function delete($id) {
        DB::run("DELETE FROM tasks WHERE id=?", $id);
        DB::run("DELETE FROM comments WHERE task=?", $id);
    }
}