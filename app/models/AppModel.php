<?php
namespace app\models;
use blog\base\Model;
class AppModel extends Model
{
       public function getCategories()
       {
        return \R::find('categories');
       }

       public function getCount($table)
      {
        return \R::count($table);
      }
       public function getAll($table_name,$field=null, $value=null, $select_field = '*')
      {
         if ($field AND $value) {
            return \R::getAll("SELECT $select_field FROM $table_name WHERE $field = ?", $value);
         } else {
            return \R::getAll("SELECT $select_field FROM $table_name");
         }
        //$post_category[] = \R::getAll("SELECT * FROM posts_content WHERE id = ?", [$post_info['id_post']]);
      }

      public function findQuery($table, $field, $value, $type = null)
    {
        if ($type == 'one') {
            return \R::findOne($table, "$field=?", [$value]);
        }
        else if (!$type) {
        return \R::find($table, "$field = ?", [$value]);
        }
    }

}
