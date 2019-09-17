<?php

abstract class View
{
    protected $data = [];

    abstract protected function content();

    public function get($name) {
        return $this->data[$name] ?? '';
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function render() {
        $this->header();
        $this->content();
        $this->footer();
    }

    protected function header() {
        require_once __DIR__.'/../Templates/header.php';
    }



    protected function footer() {
        require_once __DIR__.'/../Templates/footer.php';
    }
}