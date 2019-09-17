<?php

class Controller
{
    protected $model = null;
    protected $view = null;

    public function __construct($name) {
        $M = $name.'Model';
        $V = $name.'View';
        $this->model = new $M();
        $this->view = new $V();
    }


    public function run() {
        $this->view->setData($this->model->getData());
        $this->view->render();
    }
}