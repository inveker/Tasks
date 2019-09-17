<?php

class RegisterView extends BaseView
{
    protected function content() {
        $this->tmp('register/start');
        if(empty($_SESSION['auth'])) {
            if($this->get('success') === true)
                $this->tmp('register/success');
            else
                $this->tmp('register/form');
        } else echo "You are LogIn {$_SESSION['auth']}";
    }
}