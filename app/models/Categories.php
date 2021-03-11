<?php
namespace app\models;
class Categories extends AppModel
{
    public function getCategories()
    {
     return \R::find('categories');
    }
    
    public function editCategory($id_cat)
    {
        if (isset($_POST['name']) AND isset($_POST['alias'])) {
            //доделать обработку формы на пустоту и корректность!!!!!!!!!!!
            return \R::exec("UPDATE `categories` SET `name` = ?, `alias` = ? WHERE `id` = ?", [$_POST['name'], $_POST['alias'], $id_cat]);
        }
    }
    public function deleteCategories($id_cat)
    {
        // ЕСЛИ УДАЛЯЕТСЯ КАТЕГОРИЯ, ТО ДОЛЖНА ЛИ ОНА УДАЛИТЬСЯ ИЗ ИЗ ПОСТОВ?????????????????????????????????
        $delete_cat = \R::exec("DELETE FROM `categories` WHERE `id`=?", [$id_cat]);
        if ($delete_cat) {
            return \R::exec("DELETE FROM `posts` WHERE `id_category`=?", [$id_cat]);
        }
    }
    public function addCategories($name, $alias)
    {
        // ЕСЛИ УДАЛЯЕТСЯ КАТЕГОРИЯ, ТО ДОЛЖНА ЛИ ОНА УДАЛИТЬСЯ ИЗ ИЗ ПОСТОВ?????????????????????????????????
        return \R::exec("INSERT INTO categories (`name`, `alias`) VALUES (?,?)", [$name, $alias] );
    }
}