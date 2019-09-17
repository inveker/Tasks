<?php

abstract class BaseView extends View
{
    abstract protected function content();

    protected function header() {
        $this->tmp('header/start');
        $this->menu();
        $this->tmp('header/end');
    }

    protected function footer() {
        $this->tmp('footer');
    }

    private function menu() {
        if(empty($_SESSION['auth']))
            $this->tmp('header/menuguest');
        else
            $this->tmp('header/menuauth');
    }
}