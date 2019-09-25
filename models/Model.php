<?php

class Task
{
    protected $id
    protected $code;
    protected $author;
    protected $description;
    protected $date;
    protected $comments;

    public function __construct($id = null) {
        if($id === null) 
            $this->createNewTask();
        $this->getTaskFromDB();
    }

    protected function createNewTask() {
        if($_SESSION['auth'] !== null){ //Уровень доступа АВТОРИЗИРОВАН
            if(isset($_POST['description']) && isset($_POST['code'])) {
                DB::run("INSERT INTO tasks SET description=?, code=?, author=?",
                            $_POST['description'], $_POST['code'], $_SESSION['auth']);
                $this->id = DB::lastInsertId();
            } else {
                throw new Exception("No data was received from the POST request");
            }
        } else {
            throw new Exception("Inadequate Access Level");
        }
    }

    protected function getTaskFromDB() {
        try {
            $task = DB::run("SELECT * FROM tasks WHERE id=?", $this->id)->fetch();
        } catch (PDOException $e) {
            throw new Exception("Task not found");
        }
        $this->code        = $task['code'];
        $this->author      = $task['author'];
        $this->description = $task['description'];
        $this->date        = $task['date'];
        $this->comments    = $task['comments'];
    }

    protected static function updateTask() {
        if(isset($_POST['description']) && isset($_POST['code'])) {
            DB::run("UPDATE tasks SET description=?, code=? WHERE id=?",
                        $_POST['description'], $_POST['code'], $id);
            return true;
        }
    }

    public static function previewsGenerator() {
        $previews =  DB::run("SELECT id, description, author FROM tasks")->fetchAll();
        $previews = array_reverse($previews);
        foreach ($previews as $preview) {
            yield $preview;
        }
    }
}