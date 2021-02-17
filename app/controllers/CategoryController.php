<?php
namespace app\controllers;
class CategoryController extends AppController
{
public function showAction()
{
    $alias = $this->route['alias'];
    $posts_category = \R::findOne('categories', 'name=?', [$alias]);
    // debug($posts_category);
    if (!$posts_category) {
        throw new \Exception('Страница не найдена', 404);
    }
    // $post_id = $posts_category['id']; //id категории
    $list_posts = \R::find('posts', 'id_category = ?',[$posts_category['id']]);
    if (!$list_posts) {
        $allPosts = null;
    } else {
        foreach ($list_posts as $key => $post_info) {
            // $post_category = \R::findAll('posts_content', 'id = ?', [$post_info['id_post']]);
            $post_category[] = \R::getAll("SELECT * FROM posts_content WHERE id = ?", [$post_info['id_post']]);
            // debug($post_category);
            // $all_posts_category[] = array_values($post_category); //список всех постов
        }
        foreach ($post_category as $ind => $value) {
            foreach ($value as $key => $post) {
                $allPosts[] = ($post);
            }
        }
    }
    $this->setMeta($posts_category['name']);
    $this->set(compact('allPosts'));
}
}