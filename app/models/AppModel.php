<?php
namespace app\models;
use blog\base\Model;
class AppModel extends Model
{
      public function getOneRow($table_name, $sql, $value)
      {
        return \R::findOne($table_name, $sql, $value);
      }

      
      // public function getOneCell($cell,$table_name, $field, $value)
      // {
      //   return \R::getCell("SELECT $cell FROM $table_name WHERE $field = ?", $value);
      // }

}
