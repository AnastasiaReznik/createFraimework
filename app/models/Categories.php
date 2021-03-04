<?php
namespace app\models;
class Categories extends AppModel
{
    public function getCategories()
    {
     return \R::find('categories');
    }
}