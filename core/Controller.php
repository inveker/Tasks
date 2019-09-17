<?php

abstract class Controller
{
    protected $model = null;
    protected $view = null;

    abstract protected function setModel();
    abstract protected function setView();

    protected function set() {
        $this->setModel();
        $this->setView();
    }

    public function run() {
        $this->set();
        $this->view->setData($this->model->getData());
        $this->view->render();
    }
}