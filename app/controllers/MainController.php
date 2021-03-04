<?php
namespace app\controllers;
use app\libs\Pagination;
use blog\App;
use app\models\Post;
class MainController extends AppController
{
    public function indexAction()
    {
        $this->setMeta('Главная страница');

        $postModel = new Post();
        $countPosts = $postModel->getCountPosts();
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $countPostsOnPage =(App::$app->getProperty('count_post_on_page'));
        $pagination = new Pagination($currentPage,$countPosts, $countPostsOnPage);
        $from = $pagination->getStart();

        $allPosts = $postModel->getAllPosts($from, $countPostsOnPage);

        $cat = $this->allcategories;
        $this->set(compact('allPosts', 'pagination', 'cat'));
    }

}
