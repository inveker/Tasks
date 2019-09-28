<?php

class CommentModel
{
    public static function getComments($taskId) {
        try {
            $comments = DB::run("SELECT * FROM comments WHERE task=?", $taskId)->fetchAll();
            $comments = array_reverse($comments);
            foreach ($comments as $comment) {
                yield $comment;
            }
        } catch (PDOException $e) {
            throw new Exception("Failed DB request");
        }
    }

    public static function addComment($taskId) {
        if(isset($_POST['comment'])) {
            $comment = htmlspecialchars($_POST['comment']);
            try {
                DB::run("INSERT INTO comments SET comment=?,
                                                  author=?,
                                                  task=?,
                                                  date=?",
                                                  $comment,
                                                  $_SESSION['auth'],
                                                  $taskId,
                                                  date('Y-m-d H:i:s', time()));
            } catch (PDOException $e) {
                if($e->getCode() == 22001) {
                    throw new Exception("Allowed comment size 200 characters");
                }
                throw new Exception("Failed to add new comment");
            }
        }
    }
}