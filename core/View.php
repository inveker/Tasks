<?php

abstract class View
{
    protected $data = [];

    abstract protected function content();
    abstract protected function header();
    abstract protected function footer();

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

    protected function tmp($path) {
        require __DIR__."/../Templates/$path.php";
    }
}