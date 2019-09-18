<?php

class PreviewView extends BaseView
{
    protected function content() {
        $this->tmp('preview/start');
        foreach($this->tasks as $task) {
            $this->task = $task;
            $this->tmp('preview/task');
       }
    }
}