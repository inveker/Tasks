<?php

abstract class View
{
    protected $data = [];

    abstract public function render();

    public function __construct($data = null) {
        $this->data = $data;
        $this->render();
    }

    protected function tmp($path) {
        require __DIR__."/../Templates/$path.php";
    }

    public function __get($name) {
        if(array_key_exists($name, $this->data)) {
            return $this->data[$name];
        } return [null];
    }

    public function __set($name, $value) {
        $this->data[$name] = $value;
    }
}