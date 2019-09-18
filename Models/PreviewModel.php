<?php

class PreviewModel extends Model
{
    protected $tasks = [];
    protected $title = '';

    public function __construct() {
        $this->title = 'Preview';
        $query = DB::run("SELECT * FROM tasks")->fetchAll();
        $this->tasks = array_reverse($query);
    }
}