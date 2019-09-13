<?php

class Engine
{
    private $_page_file = null;

    public function __construct()
    {
        if(isset($_GET['page'])) {
            //Фильтруем и сохраняем адрес страницы
            $this->_page_file = preg_replace("/\/*\.*\s*/", '', $_GET['page']);

            //Если страница не существует выводим 404 и завершаем работу
            if(!file_exists('templates/' . $this->_page_file . '.php')) {
                header("HTTP/1.0 404 Not Found");
                exit();
            }
        } else $this->_page_file = 'main';
    }

    public function getPage() {
        require_once 'templates/' . $this->_page_file . '.php';
    }
}