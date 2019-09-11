<?php
session_start();
require_once 'header.php';
if(isset($_GET['id'])){
    require_once 'DB.php';
    require_once 'functions.php';
    $id = $_GET['id'];
    $q = DB::run("SELECT * FROM tasks WHERE id=?", $id);
    $q = $q->fetch();
    showTask($q);

    if(isset($_SESSION['user'])) {
        echo <<<_HTML
    <form method="post">
      <input type="hidden" name="id" value='$id'>
      <input type="submit" name="delete" value="Delete">
    </form>
_HTML;
    }

}
require_once 'footer.php';
