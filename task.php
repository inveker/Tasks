<?php

if(isset($_GET['id'])){
    require_once 'DB.php';
    $id = $_GET['id'];
    $q = DB::run("SELECT description, code, created FROM tasks WHERE id=$id");
    $q = $q->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['delete'])) {
        DB::run("DELETE FROM tasks WHERE id=?", $_POST['id']);
        header("Location: index.php");
    }

    $description = $q['description'];
    $code = highlight_string($q['code'], true);
    echo <<<_HTML
<div class="task">
    <h3>Description</h3>
    <p>$description</p>
    <h3>Code</h3>
    <code>$code<code>
_HTML;
    if(isset($_SESSION['user']) && $_SESSION['user'] === $q[$i]['created']) {
        echo <<<_HTML
    <form method="post">
      <input type="hidden" name="id" value='$id'>
      <input type="submit" name="delete" value="Delete">
    </form>
_HTML;
    }
    echo '</div>';
}
