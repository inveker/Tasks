<?php

class BaseController extends NormalController
{
    protected static function exeptionHandler($e) {
        $view = new NormalView('Error');
        $view->addElement('error', $e->getMessage())->render();
    }
}