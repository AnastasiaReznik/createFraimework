<?php
namespace app\controllers\admin;
use app\models\Admin;
class UserController extends AppController
{
    public function loginAdminAction()
    {
        $this->layout = 'login';
        if (isset($_POST) AND !empty($_POST)) {
            $adminModel = new Admin();
            $resAdmin = $adminModel->login();

            if ($resAdmin !== true) {
                $error = $resAdmin;
                $this->set(compact('error'));
            } else {
                header("Location: " . ADMIN);
            }
        }
    }
}