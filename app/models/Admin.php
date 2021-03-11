<?php
namespace app\models;
class Admin extends AppModel
{
    public function login() {
        if (!empty($_POST['login']) AND !empty($_POST['password'])) {
            $login = trim($_POST['login']);
            $password = trim($_POST['password']);
            $admin = $this->getOneRow('admins', "login = ?", [$login]);
            if ($admin) {
                if (password_verify($password, $admin->password)) {
                    //записать в сессию
                    foreach($admin as $k => $v){
                        if($k != 'password') $_SESSION['admin'][$k] = $v;
                    }
                    return true;
                    // $_SESSION['admin'] = true;
                } return  'Неверный пароль'; //неверный пароль
            } return 'Неверный логин'; //неверный логин
            // return $admin;
        } return 'Все поля необходимо заполнить!'; //пустые поля
    }

    //проверка выполнен ли вход
    // public static function checkAuth() {
    //     return isset($_SESSION['admin']);
    // }
}