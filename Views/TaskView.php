<?php

class TaskView extends BaseView
{
    protected function content() {
        //Если поиск таска удался
        if($this->get('result') !== false) {
            $this->tmp('task/start');
            $this->tmp('task/starttask');
            if($_SESSION['auth'] === $this->get('author'))
                $this->tmp('task/controlstask');
            $this->tmp('task/endtask');
            if($_SESSION['auth'])
                $this->tmp('task/formcomment');
            foreach ($this->get('comments') as $comment) {
                $this->data['comment_text'] = $comment['comment'];
                $this->data['comment_author'] = $comment['author'];
                $this->tmp('task/comment');
            }
        } else $this->tmp('task/notfound');//Если таска не существует
    }
}