<?php

class Task extends Controller
{
    public static function preview($page=1) {
        $previews = TaskModel::getPreviews($page);
        self::header("Tasks preview");
        foreach ($previews as $preview) {
            View::render('task_preview', $preview);
        }
        self::footer();
    }

    public static function show($id) {
        $task = TaskModel::getTask($id);
        if($task) {
            self::header("Task $id");
            View::render('task', $task);
            if($_SESSION['auth'] === $task['author'])
                View::render('task_controls', $task);
            if($_SESSION['auth'])
                View::render('comment_form', $task);
            $comments = CommentModel::getComments($id);
            foreach ($comments as $comment) {
                View::render('comment', $comment);
            }
            self::footer();
        }
    }

    public static function edit($id) {
        $task = TaskModel::getTask($id);
        if($task) {
            if($_SESSION['auth'] === $task['author']) {

                if(isset($_POST['description']) && isset($_POST['code'])) {
                    DB::run("UPDATE tasks SET description=?, code=? WHERE id=?",
                                    $_POST['description'], $_POST['code'], $id);
                    header("Location: /task/show/$id");
                }
                self::header("Edit task $id");
                View::render('task_edit_form', $task);
                self::footer();
            }
        }
        
    }

    public function delete() {

    }
}