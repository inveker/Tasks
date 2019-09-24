<?php

class NormalView extends BaseView
{
    protected $title;

    public function __construct($title = 'Tasks') {
        $this->title = $title;
    }

    public function render() {
        //Подключаем шапку
        $title = $this->title;
        require_once $this->tmp('header_start');
        if($_SESSION['auth'] === null)
            require_once $this->tmp('menu_guest');
        else
            require_once $this->tmp('menu_auth');
        require_once $this->tmp('header_end');
        //Подключаем содержимое страницы
        parent::render();
        //Подключаем подвал
        require_once $this->tmp('footer');
    }
}