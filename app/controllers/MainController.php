<?php
namespace app\controllers;
use \Controller;
use blog\Db;
use blog\Cache;
use app\libs\Pagination;
use blog\App;
use app\models\Main;
class MainController extends AppController
{
    public function indexAction()
    {
        $this->setMeta('Главная страница');
        // 1-настроить пагинацию
        //текущая страница - из гет, кол-во постов на странице из конфига,
        // $countPosts = \R::count('posts_content');
        $modelObj = new Main();
        $countPosts = $this->baseModel->getCount('posts_content');
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        // debug($countPosts);
        $arrProp =(App::$app->getProperties());
        $countPostsOnPage = $arrProp['count_post_on_page'];
        // debug($countPostsOnPage);
        $pagination = new Pagination($currentPage,$countPosts, $countPostsOnPage);
        $from = $pagination->getStart();

        $allPosts = $modelObj->findAllPosts($from, $countPostsOnPage);

        $cat = $this->allcategories;
        $this->set(compact('allPosts', 'pagination', 'cat'));
    }
}
