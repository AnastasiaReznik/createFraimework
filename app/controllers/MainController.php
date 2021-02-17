<?php
namespace app\controllers;
use \Controller;
use blog\Db;
use blog\Cache;
use  blog\libs\Pagination;
use  blog\App;
class MainController extends AppController
{
    public function indexAction()
    {
        $this->setMeta('Главная страница');
        // 1-настроить пагинацию
        //текущая страница - из гет, кол-во постов на странице из конфига,
        $countPosts = \R::count('posts_content');
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        // debug($countPosts);
        $arrProp =(App::$app->getProperties());
        $countPostsOnPage = $arrProp['count_post_on_page'];
        // debug($countPostsOnPage);
        $pagination = new Pagination($currentPage,$countPosts, $countPostsOnPage);
        $from = $pagination->getStart();

        $allPosts = \R::findAll('posts_content', "ORDER BY id DESC LIMIT $from, $countPostsOnPage");
        $this->set(compact('allPosts', 'pagination'));
    }
}
