<?php
namespace app\controllers;
use \Controller;
use createFramework\Db;
use createFramework\Cache;
class MainController extends AppController
{
    public function indexAction()
    {
        $posts = \R::findAll('test');
        $post = \R::findOne('test', 'id = ?', [2]);
        // debug($post);
        $this->setMeta('Главная страница', 'Описание', 'Ключевики');

        // $this->set(['name' => 'Anasreosha', 'age' => 99]);

        $name = 'John';
        $age = 30;
        $names = ['Andreu', 'Pavrut', 'Dasha'];
        $cache = Cache::instance();
        // $cache->set('test', $names);
        // $cache->delete('test');
        $data = $cache->get('test');
        if (!$data) {
            $cache->set('test', $names);
        }
        // debug($data);
        $this->set(compact('name', 'age', 'names', 'posts')); //сделать массив с ключами name age
    }
}
