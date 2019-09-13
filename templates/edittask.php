<?php

$q = DB::run("SELECT author FROM tasks WHERE id=?", $_GET['id'])->fetch();
if($_SESSION === $q['author']) { //Проверка на наличие доступа
    //Скрипт обрабатывающий форму
    $msg = '';
    if(isset($_POST['task_up'])) { //Обновление таска
        $description = $_POST['description'];
        $code = $_POST['code'];
        $idtask = $_POST['id'];

        try {
            DB::run("UPDATE tasks SET description=?, code=? WHERE id=?", $description, $code, $idtask);
            header("Location: ?page=task&id=$idtask");
            exit();
        } catch (PDOException $e) {
            //Что то пошло не так
            $msg = "Update task Error";
        }
    } elseif(isset($_POST['delete_task'])) { //Удаление таска
        try {
            DB::run("DELETE FROM tasks WHERE id=?", $_POST['id']);
            header('Location: ?page=main');
        } catch (PDOException $e) {
            //Что то пошло не так
        }
        exit();
    }

    //Скрипт генерируюший страницу
    $q = DB::run("SELECT * FROM tasks WHERE id=?", $_GET['id'])->fetch();
    if($q) {
        $description = $q['description'];
        $code = $q['code'];
        $idtask = $q['id'];
        $author = $q['author'];
        if($author !== $_SESSION['auth']) die('Not permission');
    }

    ?>
    <form action="" method="post">
        Текст задачи<input name="description" value="<?= $description ?>" type="text" required>
        Программа решения<textarea name="code" rows="15" required><?= $code ?></textarea>
        <input type="hidden" name="id" value="<?= $idtask ?>">
        <input type="submit" name="task_up">
        <b><?= $msg ?></b>
    </form>
<?php
} else die('Not permission');