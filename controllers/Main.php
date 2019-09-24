<?php

class Main
{
    public static function preview() {
        $view = new NormalView('Preview');
        $previews = TaskModel::getPreviews();
        foreach ($previews as $preview) {
            $view->addElement('preview', $preview);
        }
        $view->render();
    }

    public static function page404() {
        $view = new NormalView('404 Not found');
        $view->addElement('error', '404 Not Found')->render();
    }
}