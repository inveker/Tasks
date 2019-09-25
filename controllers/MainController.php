<?php

class MainController
{
    public static function previewAction() {
        $view = new NormalView('Preview');
        $previews = TaskModel::getPreviews();
        foreach ($previews as $preview) {
            $view->addElement('preview', $preview);
        }
        $view->render();
    }

    public static function page404Action() {
        $view = new NormalView('404 Not found');
        $view->addElement('error', '404 Not Found')->render();
    }
}