<?php
namespace app\controllers;
use app\models\About;
class AboutController extends AppController
{
    public function indexAction()
    {
        $this->setMeta('About');
        $modelObj = new About();
        $categories = $this->baseModel->getAll('categories', null, null, 'name');
        $countPosts = $this->baseModel->getCount('posts_content');
        $firstDate = $modelObj->getRowQuery("SELECT * FROM `posts_content`LIMIT 1");
        $lastDate = $modelObj->getRowQuery("SELECT * FROM `posts_content` ORDER BY id DESC LIMIT 1");
        $cat = $this->allcategories;
        $this->set(compact('categories', 'countPosts', 'firstDate','lastDate','cat'));
    }
}
