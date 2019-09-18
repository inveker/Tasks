<?php

class NewtaskModel extends Model
{
    public function __construct() {
        if(isset($_POST['new_task'])) {
            try {
                DB::run("INSERT INTO tasks SET description=?, code=?, author=?",
                        $_POST['description'], $_POST['code'], $_SESSION['auth']);
                $this->success = true;
            } catch (PDOException $e) {
                $this->success = false;
            }
        }
    }
}