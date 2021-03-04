<?php
namespace app\controllers;
use app\models\Post;
use app\libs\Pagination;
use blog\App;
class SearchController extends AppController
{
    public function indexAction()
    {
        if (isset($_GET['search'])) {
            $resSearch = $this->search();
            if (!$resSearch) {
                $allPosts = null;
            }
                $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $countPosts = count($resSearch);
                $countPostsOnPage =(App::$app->getProperty('count_post_on_page'));

                $pagination = new Pagination($currentPage,$countPosts, $countPostsOnPage);
                $from = $pagination->getStart();
                $allPosts = $this->postsOnPage($from, $countPostsOnPage, $resSearch);
                $cat = $this->allcategories;
                $this->setMeta('Поиск по сайту');
                $this->set(compact('allPosts', 'cat', 'pagination'));
        }
    }

    private function search()
    {
        $text_search = checkDataForm($_GET);
        $postModel = new Post();
        return  $postModel->search($text_search);
    }

    private function postsOnPage($from,$countPostsOnPage, $arr)
    {
        $arr = array_reverse($arr);
        $arrayPosts = array_slice($arr, $from, $countPostsOnPage);
        return (($arrayPosts));
    }
}