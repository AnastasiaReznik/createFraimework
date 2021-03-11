<?php
namespace app\controllers\admin;
use app\models\Post;
use app\models\Categories;
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
        // debug($allPosts);
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
            // debug($_POST);
            $postData = $this->checkForm();
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
        $post_edit = $this->postModel->getOneRow('posts_content', "id = ?", [$id_edit]);
        if ($post_edit) {
            $categories = $this->categoriesModel->getCategories();
            //массив id категорий, к кот относится выбранный пост для редактирования
            $arr_cat = \R::getCol("SELECT `id_category` FROM `posts` WHERE `id_post` = ?", [$post_edit['id']]);

            if (isset($_POST) AND !empty($_POST)) {
                if (empty($_POST['image'])) {
                    $_POST['image'] = $post_edit['image'];
                } else {
                    $_POST['image'] = '/public/image/' . $_POST['image'];
                }
                $post = $this->checkForm();
                
                $this->postModel->editPost($post, $id_edit);
            }

            $this->setMeta('Редактирование статьи');
            $this->set(compact('post_edit', 'categories', 'arr_cat'));
        } else {
            throw new \Exception("Страница не найдена", 404);
        }
    }

    public function checkForm()
    {
        foreach ($_POST as $key => $value) {
            if ($key !== 'files') {
                if (empty($value)) {
                    return false; //пустые поля
                } else {
                    if ($key !== 'id_category' AND $key !== 'files') {
                        $_POST[$key] = trim($value);
                        $_POST[$key] = htmlspecialchars($value,  ENT_QUOTES);
                    }
                }
            }
        }
        return $_POST;
    }
}