<?php

class TaskModel extends Model
{
    public function __construct() {
        if(isset($_GET['id'])) {
            //Ищем запрошенный таск
            $task = DB::run("SELECT * FROM tasks WHERE id=?", $_GET['id'])->fetch();
            //Если таск существует
            if($task) {
                $this->data['id'] = $task['id'];
                $this->data['title'] = 'Task '.$task['id'];
                $this->data['description'] = $task['description'];
                $this->data['code'] = $task['code'];
                $this->data['author'] = $task['author'];
                //Добавляем новый комментарий
                if(isset($_POST['comment'])) {
                    DB::run("INSERT INTO comments SET comment=?, author=?, task=?", $_POST['comment_text'], $_SESSION['auth'], $task['id']);
                }
                //Ищем комментарии таска
                $comments = DB::run("SELECT * FROM comments WHERE task=?", $task['id'])->fetchAll();
                if($comments) {
                    $this->data['comments'] = $comments; //Если существуют комментарии - записываем их
                } else $this->data['comments'] = []; //Если комментариев не существует возвращаем пустой массив
            } else $this->data['result'] = false; //Если id не найден
        } else $this->data['result'] = false; //Если id не указан
    }
}