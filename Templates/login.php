<!--Login page-->
<h2>Login</h2>
<?php if($_SESSION['auth']):?>
    <p>Login success<p>
    <p>Hello <?=$_SESSION['auth']?></p>
<?php else:?>
    <form action="" method="post">
        <input type="text" name="username" required>
        <input type="password" name="password" required>
        <input type="submit" name="login">
        <?=$this->get('error')?>
    </form>
<?php endif;