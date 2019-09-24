<?php

class BaseView
{
    protected $queue = [];

    public function addElement($path, $data = []) {
        if(is_string($data)) $data = ['message' => $data];
        static $i = 0;
        $this->queue[$i]['path'] = $path;
        $this->queue[$i]['data'] = $data;
        $i++;
    }

    public function render() {
        foreach ($this->queue as $element) {
            extract($element['data']);
            require "templates/{$element['path']}.php";
        }
    }

    protected function tmp($name) {
        return "templates/$name.php";
    }
}