<?php

abstract class Model
{
    abstract public function __construct();

    public function getData() {
        $arr = get_object_vars($this);
        return $arr;
    }
}