<?php
namespace app\models;
// use blog\base\Model;
class About extends AppModel
{
    public function getRowQuery($query)
    {
        return \R::getRow($query);
    }
}