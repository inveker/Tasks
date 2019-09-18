<?php

class TaskView extends BaseView
{
    protected function content() {
        //Если поиск таска удался
        if($this->task) {
            //Заголовок
            $this->tmp('task/start');
            //Таск
            $this->tmp('task/starttask');
            if($_SESSION['auth'] === $this->task['author'])
                $this->tmp('task/controlstask');
            $this->tmp('task/endtask');
            //Форма комментария
            if($_SESSION['auth'])
                $this->tmp('task/formcomment');
            //Комментарии
            foreach ($this->comments as $comment) {
                $this->comment = $comment;
                $this->tmp('task/comment');
            }
        } else $this->tmp('task/notfound');//Если таска не существует
    }
}