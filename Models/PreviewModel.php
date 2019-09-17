<?php

class PreviewModel extends Model
{
    public function __construct() {
        $this->data['title'] = 'Preview';
        $query = DB::run("SELECT * FROM tasks")->fetchAll();
        $this->data['tasks'] = $query;
    }
}