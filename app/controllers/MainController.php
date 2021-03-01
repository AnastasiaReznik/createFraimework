<?php
namespace app\controllers;
use app\libs\Pagination;
use blog\App;
use app\models\Main;
class MainController extends AppController
{
    public function indexAction()
    {
        $this->setMeta('Главная страница');

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
