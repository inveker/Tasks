<form action="" method="post">
    <input type="text" name="username" required>
    <input type="password" name="password" required>
    <input type="submit" name="login">
    <?=$this->get('error')?>
</form>