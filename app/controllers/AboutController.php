<?php
namespace app\controllers;
class AboutController extends AppController
{
    public function indexAction()
    {
        $this->setMeta('About');
        $cat = $this->allcategories;
        $this->set(compact('cat'));
    }
}
