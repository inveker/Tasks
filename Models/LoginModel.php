<?php

class LoginModel extends Model
{

    public function __construct() {
        $this->data['title'] = 'Login';
        if(empty($_SESSION['auth'])) {
            $this->post();
        }
    }

    protected function post() {
        if(isset($_POST['login'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $sth = DB::run("SELECT * FROM users WHERE username=? AND password=?",
                                                        $username, $password)->fetch();
                if($sth) {
                    $_SESSION['auth'] = $username;
                } else {
                    $this->data['error'] = 'You entered incorrect data';
                }
            }
    }
}