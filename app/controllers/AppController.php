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

        $this->allcategories = $this->baseModel->getCategories();
        // debug($this->allcategories);

    }
}
