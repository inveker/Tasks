<?php

class AccountModel
{
    public static function register($username, $password) {
        try {
            DB::run("INSERT INTO users SET username=?, password=?", $username, $password);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function login($username, $password) {
        $query = DB::run("SELECT * FROM users WHERE username=? AND password=?", $username, $password)->fetch();
        if($query) return true;
        else return false;
    }
}