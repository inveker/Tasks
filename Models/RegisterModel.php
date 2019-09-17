<?php

class RegisterModel extends Model
{
    public function __construct() {
        $this->data['title'] = 'Register';
        if(isset($_POST['register'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            try {
                DB::run("INSERT INTO users SET username=?, password=?", $username, $password);
                //Пользователь зарегестрирован
                $this->data['success'] = true;
                $this->data['username'] = $username;
            } catch (PDOException $e) {
                //Такой пользователь существует
                $this->data['error'] = 'This user already exists';
            }
        }
    }
}