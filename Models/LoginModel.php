<?php
require_once __DIR__.'/../core/Model.php';

class LoginModel extends Model
{
    public function __construct() {
        if(isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $sth = DB::run("SELECT * FROM users WHERE username=? AND password=?", $username, $password)->fetch();
            if($sth) {
                $_SESSION['auth'] = $username;
            } else {
                $this->data['error'] = 'AuthFail';
            }
        }
    }
}