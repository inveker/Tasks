<?php

class Task
{
    public static function show($id = 0) {
        $task = TaskModel::getTask($id);
        if($task) {
            $task = TaskModel::getTask($id);
            $view = new NormalView('Task #'.$task['id']);
            //Добавляем таск
            $view->addElement('task', $task);
            //Если пользователь автор таска
            //Добавляем уравляющие кнопки
            if($_SESSION['auth'] === $task['author'])
                $view->addElement('task_controls');
            //Если пользователь авторизирован
            //Добавляем форму 
            if($_SESSION['auth'] !== null)
                $view->addElement('form_comment');
            //Добавляем комментраии
            $comments = CommentModel::getComments($task['id']);
            foreach ($comments as $comment) {
                $view->addElement('comment', $comment);
            }
            $view->render();
        } else {
            header('Location: /main/page404');
            exit();
        }
    }
}