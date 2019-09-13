<?php

class Task
{
    private $id = null;
    private $description = null;
    private $code = null;
    private $author = null;

    public function __construct($args) {
        $this->id = $args['id'];
        $this->description = $args['description'];
        $this->code = $args['code'];
        $this->author = $args['author'];
    }

    public function view() {
        echo "<div class='task'><p>$this->description</p>$this->code<p></p></div>";
        if($_SESSION['auth'] === $this->author) $this->addControl();
    }

    public function preview() {
        echo "<a href='?page=task&id=$this->id'><div class='preview'><p>$this->description</p></div></a>";
    }

    protected function addControl() {
        echo <<<_HTML
    <form action="?page=edittask&id=$this->id" method="post">
      <input type="submit" name="delete_task" value="Delete">
      <input type="submit" name="edit_task" value="Edit">
    </form>
_HTML;
    }
}