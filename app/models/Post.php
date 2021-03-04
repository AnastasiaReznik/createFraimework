<?php
namespace app\models;

class Post extends AppModel
{
    public function getAllPosts($from,$countPostsOnPage )
    {
        return \R::findAll('posts_content', "ORDER BY id DESC LIMIT $from, $countPostsOnPage");
    }
    public function getAllPostsOnCategory($id_category)
    {
        return \R::getAll("SELECT `posts_content`.* FROM `posts_content`, `posts` WHERE `posts_content`.id = `posts`.id_post AND `posts`.id_category = ?",[$id_category]);
    }

    public function search($search)
    {
    $find_text = trim($search['search']);
    $res_search = \R::getAll("SELECT * FROM `posts_content` WHERE `title` LIKE '%$find_text%'");
    return $res_search;
  }

  public function getCountPosts()
  {
    return \R::count('posts_content');
  }
}