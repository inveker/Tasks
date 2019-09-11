<?php
require_once 'DB.php';
if(isset($_POST['delete'])) {
    DB::run("DELETE FROM tasks WHERE id=?", $_GET['id']);
    header("Location: index.php");
    exit();
} elseif(isset($_POST['edit'])) {
    $q = DB::run("SELECT * FROM tasks WHERE id=?", $_GET['id']);
    $q = $q->fetch();
    $creater = $q['creater'];
    $code = $q['code'];
    $description = $q['description'];
    //START HTML
    require_once 'header.php';
    //START FORM?> 
    <form method="post">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        Текст задачи<input name="text" type="text" value="<?= $description ?>">
        Программа решения<textarea name="code" rows="15"><?= $code ?></textarea>
        <input type="submit" name="update">
    </form>
<?php //END FORM
    require_once 'footer.php';
    //END HTML
} elseif(isset($_POST['update'])) {
    DB::run("UPDATE tasks SET description=?, code=? WHERE id=?", $_POST['text'], $_POST['code'], $_GET['id']);
    header("Location: task.php?id={$_POST['id']}");
}