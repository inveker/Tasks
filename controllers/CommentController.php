<?php

class CommentController
{
    public static function newAction($taskId) {
        try {
            if($_SESSION['auth'] !== null) {
                CommentModel::addComment($taskId);
                header("Location: /task/show/$taskId");
                exit();
            } else {
                throw new Exception("Not permissions", 1);
            }
        } catch (Exception $e) {
            $view = new NormalView('Error');
            $view->addElement('error', $e->getMessage())->render();
        }
    }
}