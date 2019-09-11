<?php
session_start();
require_once 'DB.php';

if(isset($_POST['delete'])) {
    $q = DB::run("DELETE FROM tasks WHERE id=?", $_POST['id']);
    header("Location: index.php");
}

if(isset($_POST['edit'])) {
    $q = DB::run("SELECT * FROM tasks WHERE id=?", $_POST['id']);
    $q = $q->fetch();
    $code = $q['code'];
    $description = $q['description'];
}
?>

<form method="post">
    Текст задачи<input name="text" type="text" value='<?= $description ?>'>
    Программа решения<textarea name="code" rows="15"><?= $code ?></textarea>
    <input type="submit">
</form>