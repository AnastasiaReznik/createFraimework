<?php
namespace app\controllers;
use app\models\Post;
class PostController extends AppController
{
    public function readAction()
    {
        $alias = $this->route['alias'];
        // debug($alias);
        // $alias_
        // $update_alias =  \R::exec("UPDATE");
        $post = $this->baseModel->findQuery('posts_content', "alias", $alias);
        // debug($post);
        if (!$post) {
            throw new \Exception('Страница не найдена', 404);
        }
        // $this->setMeta($post);
        $id_post = key($post);
        $comments = $this->baseModel->findQuery('comments', 'id_post', $id_post);
        $this->setMeta($post[key($post)]['title']);
        $cat = $this->allcategories;

        //в контроллер!!!!!
        if (isset($_POST['userName']) AND isset($_POST['email']) AND isset($_POST['comment'])) {
            // debug($_POST);
        $this->checkCaptcha();
        $data_forms = checkDataForm($_POST);
        // debug($data_forms);
        //если вернулась ошибка, то показать  в разметке ошибку - поле не заполнено
        if (isset($data_forms['error'])) {
            $error = ['error' => $data_forms['error'], 'empty_field' => $data_forms['empty_field']];
            // echo 'erroors true';
        }

        $res_insert = $this->addCommentInDb($data_forms, $id_post);
        if ($res_insert) {
            $msg = 'Комментарий отправлен на проверку!';
            header("Refresh:3");
        } else {
            $msg = 'При отправке комментария произошла ошибка! Повторите позже.';
        }
        }
        if (isset($error)) {
            $this->set(compact('id_post','post', 'comments','cat', 'error'));
        } elseif (isset($msg)) {
            $this->set(compact('id_post','post', 'comments','cat', 'msg'));
        } else  {
            $this->set(compact('id_post','post', 'comments','cat'));
        }
    }
    public function checkCaptcha()
    {
        if (!$_POST['g-recaptcha-response']) {
            die('Заполните каптчу!');
            }
            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $secret_key = '6Ldo4VgaAAAAANOMj_iLFWqtx9AoilSjN9nnZaz_';
            $query = $url . '?secret=' . $secret_key . '&response='. $_POST['g-recaptcha-response'] . '&remoteip=' . $_SERVER['REMOTE_ADDR'];

            $data = json_decode(file_get_contents($query));
            if (!$data->success) {
            exit('Каптча введена неверно!');
            }
    }

            //вынести в оор
        public function addCommentInDb($comment, $id_post)
        {
            $modelObj = new Post();
            $res_insert = $modelObj->insertComment($comment, $id_post);
        if ($res_insert == 1) {
            return true;
        } else {
            return false;
        }

    }

}
