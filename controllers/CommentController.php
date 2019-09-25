<?php

class CommentController
{
    public static function newAction($taskId) {
        if($_SESSION['auth'] !== null) {
            CommentModel::addComment($taskId);
            header("Location: /task/show/$taskId");
            exit();
        } else {
            $view = new NormalView('Not permissions');
            $view->addElement('error', 'Not permissions')->render();
        }
    }
}