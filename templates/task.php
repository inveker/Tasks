<?php
//Скрипт обрабатывающий форму добавления комментария
$msg = '';
if(isset($_POST['comment_add'])) {
    $comment = $_POST['text'];
    $author = $_SESSION['author'];
    $idtask = $_POST['idtask'];

    try {
        DB::run("INSERT INTO comments SET comment=?, author=?, idtask=?", $comment, $author, $idtask);
        $msg = 'Comment Added';
    } catch (PDOException $e) {
        $msg = 'Comment Error';
    }
}

//Перенаправляем страницу по ID
if(isset($_GET['id'])) {
    $q = DB::run("SELECT * FROM tasks WHERE id=?", $_GET['id'])->fetch();
    if($q) {
        require_once 'view/Task.php';
        $task = new Task($q);
        $task->view();
    } else {
        die('Not Found');
    }
} else {
    die('Not Found');
}

if(!empty($_SESSION['auth'])):?>
<form method="post">
  <h5>Comment</h5>
  <textarea name="comment" required></textarea>
  <input type="submit" name="comment_add" value="Send">
  <b><?= $msg ?></b>
</form>
<?php endif;

// $comment = new Comment();
// $comment->view();