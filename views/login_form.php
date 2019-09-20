<form action="/account/login/" method="post">
    <input type="text" name="username" placeholder="username" autocomplete="off" required>
    <input type="password" name="password" placeholder="password" autocomplete="off" required>
    <input type="submit" name="login" value="Signin">
    <?=$message?>
</form>