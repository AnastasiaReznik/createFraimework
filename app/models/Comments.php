<?php
namespace app\models;
use app\models\AppModel;
class Comments extends AppModel
{
    public function insertComment($comment, $id_post)
    {
        return \R::exec("INSERT INTO comments (id_post, author, mail, comment) VALUES (?,?,?,?)", [$id_post, $comment['userName'], $comment['email'],  $comment['comment']]);
    }
    public function getComments($id_post)
    {
        return \R::find('comments', 'id_post = ?', [$id_post]);
    }


}