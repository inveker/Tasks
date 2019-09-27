<?php

class CommentController extends BaseController
{
    protected static function newAction($taskId) {
        if($_SESSION['auth'] !== null) {
            CommentModel::addComment($taskId);
            header("Location: /task/show/$taskId");
            exit();
        } else {
            throw new Exception("Not permissions");
        }
    }
}