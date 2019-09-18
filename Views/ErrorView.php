<?php

class ErrorView extends BaseView
{
    protected function content() {
        echo $this->get('msg');
    }
}