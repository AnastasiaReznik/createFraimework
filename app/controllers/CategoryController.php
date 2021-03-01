<?php
namespace app\controllers;
use app\models\Category;
class CategoryController extends AppController
{
public function showAction()
{
    $alias = $this->route['alias'];

    $posts_category = $this->baseModel->findQuery('categories', 'name', $alias, 'one');

    // debug($posts_category);
    if (!$posts_category) {
        throw new \Exception('Страница не найдена', 404);
    }
    // $post_id = $posts_category['id']; //id категории
    $list_posts =  $this->baseModel->findQuery('posts', 'id_category', $posts_category['id']);
    // debug($list_posts);
    if (!$list_posts) {
        $allPosts = null;
    } else {
        foreach ($list_posts as $key => $post_info) {
            // $post_category = \R::findAll('posts_content', 'id = ?', [$post_info['id_post']]);
            $post_category[] = $this->baseModel->getAll('posts_content','id', [$post_info['id_post']]);
        }
        foreach ($post_category as $ind => $value) {
            foreach ($value as $key => $post) {
                $allPosts[] = ($post);
            }
        }
    }
    $this->setMeta($posts_category['name']);
    $cat = $this->allcategories;
    $this->set(compact('allPosts','cat'));
}
}