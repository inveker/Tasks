<?php

require_once 'DB.php';
$q = DB::run("SELECT id, description, code, created FROM tasks");
$q = $q->fetchAll();

for($i = count($q) - 1; $i >= 0; $i--) {
    $description = $q[$i]['description'];
    $code = highlight_string($q[$i]['code'], true);
    $id = $q[$i]['id'];
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

if(isset($_POST['delete'])) {
    DB::run("DELETE FROM tasks WHERE id=?", $_POST['id']);
    header("Location: index.php");
}