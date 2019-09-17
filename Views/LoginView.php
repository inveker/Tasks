<?php
require_once __DIR__.'/../core/View.php';

class LoginView extends View
{
    protected function content() {
        require_once __DIR__.'/../Templates/login.php';
    }
}