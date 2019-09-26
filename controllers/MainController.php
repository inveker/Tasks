<?php

class MainController extends NormalController
{
    protected static function previewAction() {
        $view = new NormalView('Preview');
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