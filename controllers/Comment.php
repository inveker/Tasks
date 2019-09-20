<?php

class Comment extends Controller
{
    public static function add($id) {
        if($_SESSION['auth']) {
            CommentModel::addComment($id);
            header("Location: /task/show/$id");
        }
    }
}