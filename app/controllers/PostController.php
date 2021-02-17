<?php
namespace app\controllers;
class PostController extends AppController
{
    public function readAction()
    {
        $alias = $this->route['alias'];
        $post = \R::findAll('posts_content', 'alias= ?', [$alias]);
        if (!$post) {
            throw new \Exception('Страница не найдена', 404);
        }
        // $this->setMeta($post);
        $id_post = key($post);
        $comments = \R::find('comments', 'id_post = ?', [$id_post]);
        $this->setMeta($post[key($post)]['title']);
        $this->set(compact('id_post','post', 'comments'));
    }

}
