<?php
namespace app\controllers;
use app\models\AppModel;
use blog\base\Controller;

class AppController extends Controller
{
    public $baseModel;
    public $allcategories;
    public function __construct($route)
    {
        parent::__construct($route);
        $this->baseModel = new AppModel();

        if (isset($_GET['search'])) {
            $res_search = $this->search();
            // var_dump($res_search);
            if (!$res_search) {
                // echo 'постов не найдено!';
               } else {
                //   echo 'посты найдены';
                
                  //вызвать функ-ию, кот выполнит редирект на стр с рез-тами поиска и передать в рендер эти посты
               }
        }

        $this->allcategories = $this->baseModel->getCategories();
        // debug($this->allcategories);

    }

    public function search()
    {
        // if (isset($_GET['search'])) {
            // echo 'get yes!';
            $get_search = checkDataForm($_GET);
            // debug($get_search);
           return  $this->baseModel->search($get_search);

    }

}
