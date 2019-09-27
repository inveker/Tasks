<?php

class BaseController extends NormalController
{
    protected static function exeptionHandler($e) {
        $view = new BaseView('Error');
        $view->addElement('error', $e->getMessage())->render();
    }
}