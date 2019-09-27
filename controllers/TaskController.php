<?php

class TaskController extends BaseController
{

    protected static function showAction($id = 0) {
            $task = TaskModel::getTask($id);
            $task['code'] = htmlspecialchars_decode($task['code']);
            $task['code'] = highlight_string($task['code'], true);

            $view = new BaseView('Task #'.$id);
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
    }

    protected static function editAction($id = 0) {
        $task = TaskModel::getTask($id);
        if($_SESSION['auth'] === $task['author']) { //Доступ только для автора таска
            if(TaskModel::updateTask($task['id']) === true) { //Если таск был обновлен
                header('Location: /task/show/'.$task['id']);
                exit();
            }
            $view = new BaseView('Edit #'.$task['id']);
            $view->addElement('edit_task_form', $task)->render();
        } else { 
            throw new Exception("Not permissions");
        }
    }

    protected static function newAction() {
        if($_SESSION['auth'] !== null) { //Доступ только для авторизированных пользователей
            $id = TaskModel::addNewTask();
            if($id) { //Если модель удачно выполнилась
                header("Location: /task/show/$id");
            exit();
            }
            $view = new BaseView('New task');
            $view->addElement('new_task_form')->render();
        } else {
            throw new Exception("Not permissions");
        }
    }

    protected static function deleteAction($id) {
        $task = TaskModel::getTask($id);
        if($_SESSION['auth'] === $task['author']){
            TaskModel::delete($id);
            $view = new BaseView('Task #'.$task['id'].' delete');
            $view->addElement('message', 'Task #'.$task['id'].' has been deleted');
            $view->render();
        } else {
            throw new Exception("Not permissions");
        }
    }
}