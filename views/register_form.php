<form action="/account/register/" method="post">
    <input type="text" name="username" placeholder="username" autocomplete="off" required>
    <input type="password" name="password" placeholder="password" autocomplete="off" required>
    <input type="submit" name="register" value="Signup">
    <?=$message?>
</form>