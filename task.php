<?php

$id = $_GET['id'] ?? null;
require_once 'DB.php';

if(isset($_POST['comment'])) {
    require_once 'DB.php';
    DB::run("INSERT INTO comments SET comment=?, creater=?, task=?", $_POST['text'], $_POST['user'], $id);
}


$q = DB::run("SELECT * FROM tasks WHERE id=?", $id);
$q = $q->fetch();
if($q) {
    $creater = $q['creater'];
    $id = $q['id'];
    $code = $q['code'];
    $description = $q['description'];

    //START HTML
    require_once 'header.php';
    require_once 'functions.php';
    showTask($q);

    if($user === $creater) {
      //START IF CONTROL BUTTONS?>
    <form action="edittask.php?id=<?= $id ?>" method="post">
      <input type="submit" name="delete" value="Delete">
      <input type="submit" name="edit" value="Edit">
    </form>
    <?php } //END IF CONTROL BUTTONS
//START COMMENT FORM?> 
      <br>
    <form method="post">
      <h5>Comment</h5>
      <textarea name="text" required></textarea>
      <input type="hidden" name="user" value="<?= $user?>">
      <input type="submit" name="comment" value="Send">
    </form>
<?php //END COMMENT FORM
    showComments();
    require_once 'footer.php';
    //END HTML
} else {
    header("Location: index.php");
    exit();
}

function showComments() {
    $q = DB::run("SELECT * FROM comments WHERE task={$_GET['id']}");
    $q = $q->fetchAll();
    $q = array_reverse($q);
    foreach ($q as $key => $value) {
            echo "<div class='task'>{$value['comment']}</div>";
    }
}