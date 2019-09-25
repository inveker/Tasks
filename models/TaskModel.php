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
        if($task) {
            return $task;
        } else {
            throw new Exception("Task not found");
        }
        
    }

    public static function updateTask($id) {
        if(isset($_POST['description']) && isset($_POST['code'])) {
            try {
                DB::run("UPDATE tasks SET description=?, code=? WHERE id=?",
                        $_POST['description'], $_POST['code'], $id);
                return true;
            } catch (PDOException $e) {
                throw new Exception("Failed to update task");
            }
        }
    }

    public static function addNewTask() {
        if(isset($_POST['description']) && isset($_POST['code'])) {
            try {
                $q = DB::run("INSERT INTO tasks SET description=?, code=?, author=?",
                        $_POST['description'], $_POST['code'], $_SESSION['auth']);
                return DB::lastInsertId();
            } catch (Exception $e) {
                throw new Exception("Failed to add a new task to the database");
            }
        }
    }

    public static function delete($id) {4
        try {
            DB::run("DELETE FROM tasks WHERE id=?", $id);
            DB::run("DELETE FROM comments WHERE task=?", $id);
        } catch (PDOException $e) {
            throw new Exception("Error deleting task");
        }
        
    }
}