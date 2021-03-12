<?php
namespace app\controllers;
use app\models\Post;
class CategoryController extends AppController
{
public function showAction()
{
    $alias = $this->route['alias'];
    $data_category = $this->baseModel->getOneRow('categories','alias = ?', [$alias]);
    if (!$data_category) {
        throw new \Exception('Страница не найдена', 404);
    }

    $postModel = new Post();
    $allPosts = $postModel->getAllPostsOnCategory($data_category['id']);
    $this->setMeta($data_category['name']);
    $cat = $this->allcategories;
    $this->set(compact('allPosts','cat'));
}
}