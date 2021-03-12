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
            $post = checkDataForm($_POST);
                if (isset($post['empty_field'])) {
                    die('Необходимо заполнить все поля');
                }
            return \R::exec("UPDATE `categories` SET `name` = ?, `alias` = ? WHERE `id` = ?", [$post['name'], $post['alias'], $id_cat]);
        }
    }
    public function deleteCategories($id_cat, $category_from_posts)
    {
        $delete_cat = \R::exec("DELETE FROM `categories` WHERE `id`=?", [$id_cat]);
        if ($delete_cat) {
            if (in_array($id_cat, $category_from_posts)) {
                return \R::exec("DELETE FROM `posts` WHERE `id_category`=?", [$id_cat]);
            }
            else {
                return true;
            }
        }
    }
    public function addCategories($name, $alias)
    {
        return \R::exec("INSERT INTO categories (`name`, `alias`) VALUES (?,?)", [$name, $alias] );
    }
}