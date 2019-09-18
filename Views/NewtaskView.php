<?php

class NewtaskView extends BaseView
{
    protected function content() {
        if(empty($_SESSION['auth'])) {
            echo 'Not auth user';
        } else {
            $this->tmp('newtask/start');
            if($this->success === true)
                echo 'Task add';
            else
                $this->tmp('newtask/form');
        }
    }
}