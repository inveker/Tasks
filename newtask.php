<?php

//ACTION
if(isset($_POST['create'])) {
    session_start();
    require_once 'DB.php';
    DB::run("INSERT INTO tasks SET description=?, code=?, creater=?", $_POST['text'], $_POST['code'], $_SESSION['user']);
    header("Location: index.php");
    exit();
}

//START HTML
require_once 'header.php';
//START FORM?>
<form action="newtask.php" method="post">
    Текст задачи<input name="text" type="text" required>
    Программа решения<textarea name="code" rows="15" required></textarea>
    <input type="submit" name="create">
</form>
<?php //END FORM
require_once 'footer.php';
//END HTML


