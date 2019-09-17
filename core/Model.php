<?php

abstract class Model
{
    protected $data = [];

    abstract public function __construct();

    public function getData() {
        return $this->data;
    }
}