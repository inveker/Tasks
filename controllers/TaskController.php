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
            $view = new NormalView('Error');
            $view->addElement('error', $e->getMessage())->render();
        }
    }

    public static function editAction($id = 0) {
        try {
            $task = TaskModel::getTask($id);
            if($_SESSION['auth'] === $task['author']) { //Доступ только для автора таска
                if(TaskModel::updateTask($task['id']) === true) { //Если таск был обновлен
                    header('Location: /task/show/'.$task['id']);
                    exit();
                }
                $view = new NormalView('Edit #'.$task['id']);
                $view->addElement('edit_task_form', $task)->render();
            } else { 
                throw new Exception("Not permissions");
            }
        } catch (Exception $e) {
            $view = new NormalView('Error');
            $view->addElement('error', $e->getMessage())->render();
        }
    }

    public static function newAction() {
        try {
            if($_SESSION['auth'] !== null) { //Доступ только для авторизированных пользователей
                $id = TaskModel::addNewTask();
                if($id) { //Если модель удачно выполнилась
                    header("Location: /task/show/$id");
                    exit();
                }
                $view = new NormalView('New task');
                $view->addElement('new_task_form')->render();
            } else {
                throw new Exception("Not permissions");
            }
        } catch (Exception $e) {
            $view = new NormalView('Error');
            $view->addElement('error', $e->getMessage())->render();
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