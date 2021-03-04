<?php
namespace app\controllers;
use app\models\AppModel;
use app\models\Categories;
use blog\base\Controller;

class AppController extends Controller
{
    public $baseModel;
    public $categoriesModel;
    public $allcategories;
    public function __construct($route)
    {
        parent::__construct($route);
        $this->baseModel = new AppModel();
        $this->categoriesModel = new Categories();
        $this->allcategories = $this->categoriesModel->getCategories();
    }
}
