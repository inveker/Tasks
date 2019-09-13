<?php

$msg = '';

if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        DB::run("INSERT INTO users SET username=?, password=?", $username, $password);
        //Пользователь зарегестрирован
        $msg = 'You are registred';
    } catch (PDOException $e) {
        //Такой пользователь существует
        $msg = 'This user already exists';
    }
}?>

<form action="" method="post">
Login <input name="username" type="text" required><br>
Password <input name="password" type="password" required><br>
<input type="submit" name="register">
<b><?= $msg ?></b>
</form>