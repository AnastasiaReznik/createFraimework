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
                    foreach($admin as $k => $v){
                        if($k != 'password') $_SESSION['admin'][$k] = $v;
                    }
                    return true;
                } return  'Неверный пароль';
            } return 'Неверный логин';
        } return 'Все поля необходимо заполнить!';
    }
}