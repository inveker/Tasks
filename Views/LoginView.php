<?php

class LoginView extends BaseView
{
    protected function content() {
        $this->tmp('login/start');
        if(empty($_SESSION['auth']))
            $this->tmp('login/form');
        else
            $this->tmp('login/success');
    }
}