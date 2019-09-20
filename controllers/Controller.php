<?php

class Controller
{
    protected static function header($title = 'Tasks') {
        View::render('header/start', ['title'=>$title]);
        if($_SESSION['auth'])
            View::render('header/menuauth');
        else
            View::render('header/menuguest');
        View::render('header/end');
    }

    protected static function footer() {
        View::render('footer');
    }
}