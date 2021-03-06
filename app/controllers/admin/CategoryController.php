<?php
namespace app\controllers\admin;
use app\models\Categories;
class CategoryController extends AppController
{
    private $categoryModel;
    public function __construct($route) {
        parent::__construct($route);
        $this->categoryModel = new Categories();
    }
    public function indexAction()
    {
        //получить все категории из модели
        $dataPosts = $this->categoryModel->getCategories();
        //отправить их в вид
        if (isset($_GET['delete']) AND !empty($_GET['delete'])) {
           $delete_id = (int)trim($_GET['delete']);
           //список категорий из таблицы пост
           $category_from_posts = \R::getCol("SELECT `id_category` FROM `posts`");
           $res_delete = $this->categoryModel->deleteCategories($delete_id, $category_from_posts);
           if ($res_delete) {
            header("Location:" . ADMIN . "/category");
           }
        }
        $dataPosts['href_edit'] = '/admin/category/edit?id=';
        $dataPosts['href_delete'] = '/admin/category/?delete=';

        $this->setMeta('Список категорий');
        $this->set(compact('dataPosts'));
    }
    public function editAction()
    {
        $category_id = $this->getRequestID();
        $category = $this->categoryModel->getOneRow('categories', "id = ?", [$category_id]);
        if (!$category) {
            $error = true;
        }
        if (isset($error)) {
           $data_cat = false;
        } else {
            $data_cat = $category;
        }

        if (isset($_POST['name']) AND isset($_POST['alias'])) {
            $res_edit = $this->categoryModel->editCategory($category_id);
            if ($res_edit) {
                header("Location: " . ADMIN . "/category");
            } else {
                $edit_error = 'Данные не были обновлены!';
            }
        }
        if (isset($edit_error)) {
            $data_cat['edit_error'] = $edit_error;
        }
        $this->setMeta('Редактирование категории');
        $this->set(compact('data_cat'));
    }

    public function addAction()
    {
        if (isset($_POST['name']) AND isset($_POST['alias'])) {
                $data = null;
                $newCat = checkDataForm($_POST);
                if (isset($newCat['empty_field'])) {
                    die('Необходимо заполнить все поля');//найдены пустые поля!
                }
                $res_insert = $this->categoryModel->addCategories($newCat['name'], $newCat['alias']);
                if ($res_insert == true) {
                    header("Location:" . ADMIN . "/category");
                } else {
                    $data = 'Возникла ошибка при добавлении записи!';
                } //ошибка при вставке
                if ($data != null) {
                    $this->set(compact('data'));
                }
                $this->setMeta('Добавить категорию');
            }
        }
}