<?php
namespace app\controllers\admin;
use app\models\Comments;
class ViewCommentsController extends AppController
{
public function indexAction()
{
    $commentsModel = new Comments();
    $error = null;
    $comments = $commentsModel->getAllComments();
    if (isset($_POST['status']) AND !empty($_POST['status'])) {
       $res_moderate = $commentsModel->moderateComments();
       if ($res_moderate) {
        header("Location: " . ADMIN . "/view-comments");
       }
       else {
           $error = 'Возникла ошибка.Данные не обновлены!';
       }
    }
    $this->setMeta('Модерация комментариев');
    $this->set(compact('comments', "error"));
}
}