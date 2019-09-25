<?php

class TaskController
{
    public static function showAction($id = 0) {
        try {
            $task = TaskModel::getTask($id);

            $view = new NormalView('Task #'.$id);
            $view->addElement('task', $task);

            if($_SESSION['auth'] === $task['author']) {
                $view->addElement('task_controls', $task);
            }
            if($_SESSION['auth'] !== null) {
                $view->addElement('form_comment', $task);
            }
            $comments = CommentModel::getComments($task['id']);
            foreach ($comments as $comment) {
                $view->addElement('comment', $comment);
            }
            $view->render();
        } catch (Exception $e) {
            $view = new NormalView('Not Found');
            $view->addElement('error', $e->getMessage())->render();
        }
    }

    public static function editAction($id = 0) {
        $task = TaskModel::getTask($id);
        if($task) {
            $view = new NormalView('Edit #'.$task['id']);
            //Если пользователь и автор таска совпадают
            if($_SESSION['auth'] === $task['author']) {
                //Если выполнился POST запрос
                //Перенаправляем на событие show
                if(TaskModel::updateTask($task['id'])) {
                    header('Location: /task/show/'.$task['id']);
                    exit();
                }
                //Показываем форму
                $view->addElement('edit_task_form', $task)->render();
            } else
                //Добовляем сообщение о том что у пользователя нет прав
                $view->addElement('error', 'Not permissions');
        } else {
            //Если таск не найден выводим сообщение об этом
            $view = new NormalView('Not found task');
            $view->addElement('error', "Not found task #$id")->render();
        }
    }

    public static function newAction() {
        if($_SESSION['auth'] !== null) {
            $view = new NormalView('New task');
            //Если выполнился POST запрос
            //то в переменной $id будет ID новой записи
            //На которую будет перенаправлен пользователь
            $id = TaskModel::addNewTask();
            if($id) {
                header("Location: /task/show/$id");
                exit();
            }
            //Если пост запроса не было, показываем форму
            $view->addElement('new_task_form')->render();
        } else {
            $view = new NormalView('Not permissions');
            $view->addElement('error', 'Not permissions')->render();
        }
        
    }

    public static function deleteAction($id) {
        $task = TaskModel::getTask($id);
        if($_SESSION['auth'] === $task['author']){
            TaskModel::delete($id);
            $view = new NormalView('Task #'.$task['id'].' delete');
            $view->addElement('message', 'Task #'.$task['id'].' has been deleted')->render();
        } else {
            $view = new NormalView('Not permissions');
            $view->addElement('error', 'Not permissions')->render();
        }
    }
}