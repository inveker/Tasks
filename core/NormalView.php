<?php

class NormalView
{
    protected $queue = [];

    public function addElement($path, $data = []) {
        if(is_string($data)) $data = ['message' => $data];
        static $i = 0;
        $this->queue[$i]['path'] = $path;
        $this->queue[$i]['data'] = $data;
        $i++;
        return $this;
    }

    public function render() {
        foreach ($this->queue as $element) {
            extract($element['data']);
            require $this->tmp($element['path']);
        }
    }

    protected function tmp($name) {
        return PATH['TEMPLATES'].$name.'.php';
    }
}