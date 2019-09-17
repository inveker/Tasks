<?php

class PreviewView extends BaseView
{
    protected function content() {
        $this->tmp('preview/start');
        foreach($this->get('tasks') as $task) {
            $this->data['description'] = $task['description'];
            $this->data['author'] = $task['author'];
            $this->data['id'] = $task['id'];
            $this->tmp('preview/task');
       }
    }
}