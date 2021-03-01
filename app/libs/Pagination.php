<?php
namespace app\libs;
use blog\App;
class Pagination
{
    public $currentPage; //текущая страница
    public $countPostsOnPage; //perpage
    public $countPosts; //total -общее кол-во записей
    public $countPages;
    public $uri;

    // должен принимать номер текущей страницы из url, общее кол-во страниц, общее-кол-во записей
    public function __construct($currentPage, $countPosts, $countPostsOnPage) {
        // $this->countPostsOnPage = $countPostsOnPage;
        $this->countPosts = $countPosts;
        // $arrProp =(App::$app->getProperties());
        $this->countPostsOnPage = $countPostsOnPage;
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage($currentPage);
        $this->uri = $this->getParams(); //???????


    }

    public function getCountPages()
    {
        return ceil($this->countPosts/$this->countPostsOnPage) ?: 1; //количество страниц
    }

    // проверка корректности get параметра, в кот содержится номер страницы
    public function getCurrentPage($currentPage)
    {
        if (!$currentPage OR $currentPage < 1)  $currentPage = 1;
        //если запрашиваемая страница больше, чем существующее кол-во страниц - то присваем послед страницу
        if ($currentPage > $this->countPages) {
                $currentPage = $this->countPages;
            }
            return $currentPage;
        }

        // с какой записи выводить страницы
        public function getStart()
        {
            return ($this->currentPage - 1) * $this->countPostsOnPage; //с какого эл-та выводить на стр
        }

        public function getParams()
        {
            // return $_GET['page'];
            $url = $_SERVER['REQUEST_URI']; //то что после доменного имени
            $url = explode('?', $url); //разбиваем на 2 части - то что до ? и все что после
            $uri = $url[0] . '?';
            // debug($url);
            //если есть в url гет-параметры
            if (isset($url[1]) AND $url[1] != '') {
                //разбиваем гет-строку на отдельные части(гет-параметры)
                $params = explode('&', $url[1]);
                // debug($params);

                foreach ($params as $param) {
                    if (!preg_match("#page=#", $param)) {
                       $uri .= "{$param}&amp;";
                    }
                }
            }
            //вся адресная строка но без page
            return $uri;
        }

        //приводит объект к строке
        public function __toString()
        {
            return $this->getHtml();
        }

        public function getHtml()
        {
            $back = null;
            $next = null;
            $startpage = null;
            $endpage = null;
            $page2left = null;
            $page1left = null;
            $page1right = null;
            $page2right = null;

            if ($this->currentPage > 1) {
                $back = "
                <li class='page-item'>
                    <a class='page-link' href='{$this->uri}page=" . ($this->currentPage - 1). "'>
                    Назад
                    </a>
                </li>";
            }

            if ($this->currentPage < ($this->countPages)) {
                $next = "<li class='page-item'>
                <a class='page-link' href='{$this->uri}page=" . ($this->currentPage + 1) . "'>
                 Вперед
                </a>
             </li>";
            }



            if ($this->currentPage -2 > 0 ) {
                $page2left = "<li class='page-item'>
                <a class='page-link' aria-label='' href='{$this->uri}page=" . ($this->currentPage - 2) . "'>" . ($this->currentPage - 2) . "
                </a>
             </li>";
            }

            if ($this->currentPage - 1 > 0 ) {
                $page1left = "<li class='page-item'>
                <a class='page-link' aria-label='' href='{$this->uri}page=" . ($this->currentPage - 1) . "'>" . ($this->currentPage - 1) . "
                </a>
             </li>";
            }

            if ($this->currentPage + 1 <= $this->countPages ) {
                $page1right = "<li class='page-item'>
                <a class='page-link' aria-label='' href='{$this->uri}page=" . ($this->currentPage + 1) . "'>" . ($this->currentPage + 1) . "
                </a>
             </li>";
            }

            if ($this->currentPage + 2 <= $this->countPages ) {
                $page2right = "<li class='page-item'>
                <a class='page-link' aria-label='' href='{$this->uri}page=" . ($this->currentPage + 2) . "'>" . ($this->currentPage + 2) . "
                </a>
             </li>";
            }

                return '<nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center mb-4">' . $startpage.$back.$page2left.$page1left . '<li class="page-item disabled"><a class="page-link">' . $this->currentPage . '</a><li>' . $page1right.$page2right.$next.$endpage . '</ul>';
                `<li class="page-item"><a class="page-link" href="#">1</a></li>`;
        }
}

// при вызове пагинации - передаем кол-во всех постов в бд
// текущую страницу