<?php
if(!empty($_SESSION['auth'])) { //Проверка на наличие доступа

    $msg = '';

    if(isset($_POST['task_add'])) {
        $description = $_POST['description'];
        $code = $_POST['code'];
        $author = $_SESSION['auth'];

        try {
            DB::run("INSERT INTO tasks SET description=?, code=?, author=?", $description, $code, $author);
            //Такс добавлен в базу данных
            $msg = 'New task added';
        } catch (PDOException $e) {
            //Таск не добавен
            $msg = 'AddTaskFail';
        }
    }?>
    <form action="" method="post">
        Текст задачи<input name="description" type="text" required>
        Программа решения<textarea name="code" rows="15" required></textarea>
        <input type="submit" name="task_add">
        <b><?= $msg ?></b>
    </form>
<?php
} else die('Not permissions');