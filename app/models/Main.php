<?php
namespace app\models;
// use blog\base\Model;
class Main extends AppModel
{
    // public function getCount()
    // {
    //     return \R::count('posts_content');
    // }
    public function findAllPosts($from,$countPostsOnPage )
    {
        return \R::findAll('posts_content', "ORDER BY id DESC LIMIT $from, $countPostsOnPage");
    }
}