<?php

abstract class View
{
    protected $data = [];

    abstract public function render();

    protected function tmp($path) {
        require __DIR__."/../Templates/$path.php";
    }


    public function get($name) {
        return $this->data[$name] ?? '';
    }

    public function setData($data) {
        $this->data = $data;
    }


}