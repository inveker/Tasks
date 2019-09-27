<?php

class MainController extends BaseController
{
    protected static function previewAction() {
        $view = new BaseView('Preview');
        $previews = TaskModel::getPreviews();
        foreach ($previews as $preview) {
            $view->addElement('preview', $preview);
        }
        $view->render();
    }

    protected static function page404Action($controller, $action) {
        throw new Exception("404 Not Found [ $controller|$action ]");
    }
}