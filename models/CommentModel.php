<?php

class CommentModel
{
    public static function getComments($taskId) {
        $comments = DB::run("SELECT * FROM comments WHERE task=?", $taskId)->fetchAll();
        $comments = array_reverse($comments);
        foreach ($comments as $comment) {
            yield $comment;
        }
    }

    public static function addComment($taskId) {
        DB::run("INSERT INTO comments SET comment=?, author=?, task=?",
                            $_POST['comment'], $_SESSION['auth'], $taskId);
    }
}