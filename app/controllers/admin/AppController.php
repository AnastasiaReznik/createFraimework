<?php
namespace app\controllers\admin;
use blog\base\Controller;
class AppController extends Controller {
    public $layout = 'admin';
    public function __construct($route) {
        parent::__construct($route);
        if ($route['action'] != 'login-admin' AND !isset($_SESSION['admin'])) {
            header('Location:' . ADMIN . '/user/login-admin');
        }
        if (isset($_GET['logout'])) {
            session_unset();
            header("Location:" . PATH);
        }
    }

    public function getRequestID()
    {
       if (isset($_GET['id']) AND !empty($_GET['id'])) {
           return (int)$_GET['id'];
       } throw new \Exception("Страница не найдена", 404);
    }
}