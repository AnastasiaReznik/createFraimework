<?php
namespace app\controllers;
use app\models\Search;
use app\libs\Pagination;
use blog\App;
class SearchController extends AppController
{
    public function indexAction()
    {
        if (isset($_GET['search'])) {
            $resSearch = $this->search();
            // var_dump($res_search);
            if (!$resSearch) {
                $allPosts = null;
                // echo 'постов не найдено!';
            }
                $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                // debug($currentPage);
                $countPosts = count($resSearch);
                // debug($countPosts);
                $arrProp =(App::$app->getProperties());
                $countPostsOnPage = $arrProp['count_post_on_page'];
                // debug($countPostsOnPage);

                $pagination = new Pagination($currentPage,$countPosts, $countPostsOnPage);
                $from = $pagination->getStart();
                // debug($from);
                //return \R::findAll('posts_content', "ORDER BY id DESC LIMIT $from, $countPostsOnPage");
                $allPosts = $this->postsOnPage($from, $countPostsOnPage, $resSearch);
                $cat = $this->allcategories;
                $this->setMeta('Поиск по сайту');
                $this->set(compact('allPosts', 'cat', 'pagination'));
        }
    }

    public function search()
    {
            $get_search = checkDataForm($_GET);
            $search_model = new Search();
           return  $search_model->search($get_search);

    }

    public function postsOnPage($from,$countPostsOnPage, $arr)
    {
        $arr = array_reverse($arr);
        $arrayPosts = array_slice($arr, $from, $countPostsOnPage);
        return (($arrayPosts));
    //    debug(array_reverse($arrayPosts));
    }
}