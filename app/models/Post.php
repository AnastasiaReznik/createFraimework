<?php
namespace app\models;
// use blog\base\Model;
class Post extends AppModel
{
    public function insertComment($comment, $id_post)
    {
        return \R::exec("INSERT INTO comments (id_post, author, mail, comment) VALUES (?,?,?,?)", [$id_post, $comment['userName'], $comment['email'],  $comment['comment']]);
    }
}