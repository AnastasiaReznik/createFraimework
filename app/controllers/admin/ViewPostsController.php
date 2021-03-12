<?php
namespace app\controllers\admin;
use app\models\Post;
use app\models\Categories;
use blog\App;
class ViewPostsController extends AppController
{
    private $postModel;
    private $categoriesModel;
    public function __construct($route) {
        parent::__construct($route);
        $this->postModel = new Post();
        $this->categoriesModel = new Categories();
    }
    public function indexAction()
    {
        $dataPosts = $this->postModel->getAllPosts();
        $dataPosts['href_edit'] = '/admin/view-posts/edit?id=';
        $dataPosts['href_delete'] = '/admin/view-posts/?delete=';
        $error_delete = null;
        if (isset($_GET['delete'])) {
            $id_post = (int)trim($_GET['delete']);
            $res_delete = $this->postModel->deletePost($id_post);
            if ($res_delete) {
                header("Location:" . ADMIN . "/view-posts") ;
            } else {
                $error_delete = 'При удалении произошла ошибка! Попробуйте позже.';
            }
        }
        $this->setMeta('Список постов');
        $this->set(compact('dataPosts', 'error_delete'));
    }
    public function addAction ()
    {
        $this->categoriesModel =  new Categories();
        $categories = $this->categoriesModel->getCategories();
        $error=null;
        if (isset($_POST) AND !empty($_POST)) {
            $input_names = App::$app->getProperty('fields_posts_form');
            $postData = $this->checkForm($input_names);
            if ($postData) {
                $insert_post =  $this->postModel->addPost
                ($postData);
                if ($insert_post === true) {
                    header("Location: " . ADMIN . "/view-posts");
                } else {
                    $error = $insert_post;
                }
            } else {
                $error = 'Все поля должны быть заполнены!';
            }
        }
        $this->setMeta('Новый пост');
        $this->set(compact('categories', 'error'));
    }


    public function editAction()
    {
        $id_edit = $this->getRequestID();
        $res = null;
        $post_edit = $this->postModel->getOneRow('posts_content', "id = ?", [$id_edit]);
        if ($post_edit) {
            $categories = $this->categoriesModel->getCategories();
            //массив id категорий, к кот относится выбранный пост для редактирования
        //   return \R::getCol($sql, [$array_value]);


            $arr_cat = \R::getCol("SELECT `id_category` FROM `posts` WHERE `id_post` = ?", [$post_edit['id']]);

            if (isset($_POST) AND !empty($_POST)) {
                if (empty($_POST['image'])) {
                    $_POST['image'] = $post_edit['image'];
                } else {
                    $_POST['image'] = '/public/image/' . $_POST['image'];
                }
                //на проверку передать массив данных с ключами инпуттов, и пост массив
                $input_names = App::$app->getProperty('fields_posts_form');
                $post = $this->checkForm($input_names);
                if (!$post) {
                    die('Необходимо заполнить все поля!');
                }
                $res_edit = $this->postModel->editPost($post, $id_edit, $categories);
                if ($res_edit) {
                    header("Location:" . ADMIN . 'view-posts/');
                } else {
                    $res = 'Произошла ошибка при обновлении данных!';
                }
            }

            $this->setMeta('Редактирование статьи');
            $this->set(compact('post_edit', 'categories', 'arr_cat', 'res'));
        } else {
            throw new \Exception("Страница не найдена", 404);
        }
    }

    public function checkForm($arr_fields)
    {
        foreach ($arr_fields as $field => $val) {
            if (!array_key_exists($field, $_POST)) {
                $res = false; // пустые поля
                break;
            } else {
                $res = true;
            }
        }
        if (!$res) {
           return false;
        } else {
            foreach ($_POST as $key => $value) {
                if ($key !== 'files') {
                        if ($key !== 'id_category' AND $key !== 'files') {
                            $_POST[$key] = trim($value);
                            $_POST[$key] = htmlspecialchars($value,  ENT_QUOTES);
                    }
                }
            }
            return $_POST;
        }
    }
}