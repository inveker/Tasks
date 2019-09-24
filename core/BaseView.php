<?php

class BaseView
{
    protected $queue = [];

    public function addElement($path, $data = []) {
        if(is_string($data)) $data = ['message' => $data];
        static $i = 0;
        $this->queue[0]['path'] = $path;
        $this->queue[0]['data'] = $data;
        $i++;
    }

    public function render() {
        foreach ($this->queue as $element) {
            var_dump($element);
            extract($element['data']);
            require "templates/{$element['path']}.php";
        }
    }
}