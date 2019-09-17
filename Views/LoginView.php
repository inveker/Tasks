<?php

class LoginView extends BaseView
{
    protected function content() {
        $this->tmp('login/start');
        if(!empty($_SESSION['auth']))
            $this->tmp('login/success');
        else
            $this->tmp('login/form');
    }
}