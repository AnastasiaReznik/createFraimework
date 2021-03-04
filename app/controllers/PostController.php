<?php
namespace app\controllers;
use blog\App;
use app\models\Comments;

class PostController extends AppController
{
    private $commentsModel;
    public function readAction()
    {
        $alias = $this->route['alias'];
        $this->commentsModel = new Comments();

        $post = $this->baseModel->getOneRow('posts_content', 'alias = ?', [$alias]);

        if (!$post) {
            throw new \Exception('Страница не найдена', 404);
        }
        $id_post =$post['id'];
        $comments = $this->commentsModel->getComments($id_post);
        $this->setMeta($post['title']);
        $cat = $this->allcategories;

        if (isset($_POST) AND !empty($_POST)) {
            $data_forms = checkDataForm($_POST);
            $this->checkCaptcha($data_forms);
            //если вернулась ошибка, то показать  в разметке ошибку - поле не заполнено
            if (isset($data_forms['empty_field'])) {
                $fields_form = (App::$app->getProperty('fields_comments_form'));
                if (array_key_exists($data_forms['empty_field'], $fields_form))
                {
                    $error = $fields_form[$data_forms['empty_field']];
                }
            }
        $res_insert = $this->addCommentInDb($data_forms, $id_post);
        if ($res_insert) {
            $msg = 'Комментарий отправлен на проверку!';
            header("Refresh:2");
        } else {
            $msg = 'При отправке комментария произошла ошибка! Повторите позже.';
        }
        }
        $data_to_render = ['id_post' => $id_post,'post' => $post, 'comments' => $comments];
        if (isset($error)) {
            $data_to_render['error'] = $error;
        } elseif (isset($msg)) {
            $data_to_render['msg'] = $msg;
        }
            $this->set(compact('data_to_render', 'cat'));
    }
    public function checkCaptcha($data_forms)
    {
        if (!isset($data_forms['g-recaptcha-response'])) {
            $data_forms['empty_field'] = 'g-recaptcha-response';
            return $data_forms;
        }
            $url= App::$app->getProperty('url_recaptcha');
            $secret_key = App::$app->getProperty('secret_key');
            $query = $url . '?secret=' . $secret_key . '&response='. $_POST['g-recaptcha-response'] . '&remoteip=' . $_SERVER['REMOTE_ADDR'];

            $data = json_decode(file_get_contents($query));
            if (!$data->success) {
            exit('Каптча введена неверно!');
            }
    }

        private function addCommentInDb($comment, $id_post)
        {
            $res_insert = $this->commentsModel->insertComment($comment, $id_post);
        if ($res_insert == 1) {
            return true;
        } else {
            return false;
        }

    }

}
