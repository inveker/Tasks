<?php
session_start();
require_once 'header.php';

require_once 'DB.php';
    if(isset($_POST['text']) && isset($_POST['code'])) {
        DB::run("INSERT INTO tasks SET description=?, code=?, created=?", $_POST['text'], $_POST['code'], $_SESSION['user']);
    }

require_once 'footer.php';

?>

<form method="post">
    Текст задачи<input name="text" type="text">
    Программа решения<textarea name="code" rows="15"></textarea>
    <input type="submit">
</form>