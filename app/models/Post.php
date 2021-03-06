<?php

namespace app\models;

class Post extends AppModel
{
  public function getAllPosts($from = null, $countPostsOnPage = null)
  {
    if (isset($from) and isset($countPostsOnPage)) {
      return \R::findAll('posts_content', "ORDER BY id DESC LIMIT $from, $countPostsOnPage");
    } else {
      return \R::find('posts_content');
    }
  }
  public function getAllPostsOnCategory($id_category)
  {
    return \R::getAll("SELECT `posts_content`.* FROM `posts_content`, `posts` WHERE `posts_content`.id = `posts`.id_post AND `posts`.id_category = ?", [$id_category]);
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
  public function addPost($postData)
  {
    //1) вставить пост
    $status = 0;
    $image = '/public/image/' . $postData['image'];
    if (isset($postData['status'])) {
      $status = 1;
    }
    $insert_data = [$postData['title'], $image, $postData['text'], $postData['alias'], $postData['author'], $status];
    $insertNewPost = \R::exec("INSERT INTO posts_content (`title`, `image`, `text`, `alias`, `author`, `status`) VALUES (?,?,?,?,?,?)", $insert_data);
    if ($insertNewPost) {
      //2)получить его айди
      $newIdPost = \R::getInsertID();
      //3)вставить инфу в таблицу post
      $id_categories = $postData['id_category'];
      if (count($id_categories) > 0) {
        // $str_quest = "";
        // $str_value = "";
        foreach ($id_categories as $k => $val) {
          $insert_post = \R::exec("INSERT INTO `posts` (`id_post`, `id_category`) VALUES (?,?)", [$newIdPost, $val]);
          if (!$insert_post) {
            return $err_insert = true;
            break;
          }
          //формирование запроса одной строкой
          // $str_quest  .= "(?,?),";
          // $str_value .= "[$newIdPost, $val],";
        }
        if (isset($err_insert) and $err_insert === true) {
          return 'Возникла ошибка при добавлении данных в дб!'; //ошибка при вставке в таблицу posts
        }
        return true;
        //формирование запроса одной строкой
        // $str_quest = rtrim($str_quest, ',');
        // $str_value = rtrim($str_value, ',');
        // $insert_post = \R::exec("INSERT INTO `posts` (`id_post`, `id_category`) VALUES (?,?), (?,?)",[[35, 23], [23,1]]);

      } else {
        return 'Не выбрана категория!'; //категория не выбрана
      }
    } else {
      return 'Возникла ошибка при добавлении данных в дб!'; //данные не вставлены
    }
  }

  public function deletePost($id_post)
  {
    $res_delete = \R::exec("DELETE FROM `posts_content` WHERE `id`=?", [$id_post]);
    if ($res_delete) {
      $query_delete_post = \R::exec("DELETE FROM `posts` WHERE `id_post`=?", [$id_post]);
      if ($query_delete_post) {
        $comments = \R::getCol("SELECT * FROM `comments` WHERE `id_post`=?",  [$id_post]);
        if (!empty($comments)) {
          return
            \R::exec("DELETE FROM `comments` WHERE `id_post`=?", [$id_post]);
        }
      }
      return $query_delete_post;
    }
    return false;
  }

  public function editPost($post, $id_post, $all_categories)
  {
    if (isset($post['status'])) {
      $status = 1;
    } else {
      $status = 0;
    }
    // debug($status);
    $res_update =  \R::exec("UPDATE `posts_content` SET `title` = ?,  `image` = ?, `text` = ?, `alias` = ?, `author` = ?, `status` = ? WHERE `id` = ?", [$post['title'], $post['image'], $post['text'], $post['alias'], $post['author'], $status, $id_post]);
    if ($res_update) {
      //взять все id  категорий у текущего поста из бд
      $list_category_bd = \R::getCol("SELECT `id_category` FROM `posts` WHERE `id_post` = ?", [$id_post]);
      //проверить - есть ли такая категория в массиве категорий,в пост массиве
      foreach ($all_categories as $key => $id_cat) {
        if (in_array($id_cat['id'], $post['id_category']) AND !in_array($id_cat['id'], $list_category_bd )) {
          $query =  \R::exec("INSERT INTO `posts` (`id_post`, `id_category`) VALUES (?,?)", [$id_post, $id_cat['id']]);
        } elseif (!in_array($id_cat['id'], $post['id_category']) AND in_array($id_cat['id'],$list_category_bd)) {
          $query=
          \R::exec("DELETE FROM `posts` WHERE `id_post` = ? AND `id_category` = ?", [$id_post, $id_cat['id']]);
        }
      }

      if (isset($query) AND $query) {
        return true;
      }
      elseif (!isset($query_insert) AND !isset($query_delete)) {
        return true;
      } else {
        return false;
      } //ошибка при вставке категории в таблицу posts
    }
    return false; //ошибка при обновлении данных
  }
}
