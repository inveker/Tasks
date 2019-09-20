<?php

class CommentModel
{
    public static function getComments($id) {
        $comments = DB::run("SELECT * FROM comments WHERE task=?", $id)->fetchAll();
        $comments = array_reverse($comments);
        foreach ($comments as $comment) {
            yield $comment;
        }
    }

    public static function addComment($id) {
        DB::run("INSERT INTO comments SET comment=?, author=?, task=?",
                            $_POST['comment_text'], $_SESSION['auth'], $id);
    }
}