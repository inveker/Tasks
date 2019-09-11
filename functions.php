<?php 

require_once 'DB.php';

function showAllTasks() {
    $q = DB::run("SELECT * FROM tasks");
    $q = $q->fetchAll();
    foreach ($q as $key => $value) {
        echo "<a href='task.php?id={$value['id']}'>";
        showTask($value);
        echo "</a>";
    }
}

function showPreviewTasks() {
    $q = DB::run("SELECT * FROM tasks");
    $q = $q->fetchAll();
    foreach ($q as $key => $value) {
        $description = mb_substr($value['description'], 0, 100, 'UTF-8') . '...';
        $created = $value['created'];
        ?>
    <a href="task.php?id=<?= $value['id'] ?>">
    <div class='preview'>
      <h3>Description</h3>
      <?= $description ?>
      <span class='signature'>Created user: <?= $created ?></span> <br><br>
    </div>
    </a>
<?php //END HTML
    }
}

function showTask($data)
{
    $description = $data['description'];
    $code = highlight_string($data['code'], true);
    $id = $data['id']; 
    $created = $data['created'];
    //START HTML
        ?>
    <div class='task'>
      <h3>Description</h3>
      <?= $description ?>
      <h3>Code</h3>
      <?= $code ?><br>
      <span class='signature'>Created user: <?= $created ?></span> <br><br>
    </div>
<?php //END HTML
}
