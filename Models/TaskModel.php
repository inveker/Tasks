<?php

class TaskModel extends Model
{
    protected $title = '';
    protected $task = [];
    protected $comments = [];

    public function __construct() {
        if($this->getTask()) {
            $this->title = 'Task #'.$this->task['id'];
            $this->post();
            $this->getComments();
        }
    }

    protected function getTask() {
        $id = $_GET['id'] ?? -1;
        $task = DB::run("SELECT * FROM tasks WHERE id=?", $id)->fetch();
        if($task) {
            $this->task = $task;
            return true;
        } else return false;
    }


    protected function post() {
        if($_SESSION['auth']) {
            if(isset($_POST['comment'])) {
            DB::run("INSERT INTO comments SET comment=?, author=?, task=?",
                                $_POST['comment_text'], $_SESSION['auth'], $this->task['id']);
            }
        }
    }

    protected function getComments() {
        $comments = DB::run("SELECT * FROM comments WHERE task=?", $this->task['id'])->fetchAll();
        $this->comments = array_reverse($comments);
    }
}