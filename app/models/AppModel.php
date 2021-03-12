<?php
namespace app\models;
use blog\base\Model;
class AppModel extends Model
{
      public function getOneRow($table_name, $sql, $value)
      {
        return \R::findOne($table_name, $sql, $value);
      }
}
