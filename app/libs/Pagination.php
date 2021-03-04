<?php
namespace app\libs;
class Pagination
{
    public $currentPage; //текущая страница
    public $countPostsOnPage; //perpage
    public $countPosts; //total -общее кол-во записей
    public $countPages;
    public $uri;

    // должен принимать номер текущей страницы из url, общее кол-во страниц, общее-кол-во записей
    public function __construct($currentPage, $countPosts, $countPostsOnPage) {
        $this->countPosts = $countPosts;
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
            $url = $_SERVER['REQUEST_URI']; //то что после доменного имени
            $url = explode('?', $url); //разбиваем на 2 части - то что до ? и все что после
            $uri = $url[0] . '?';
            //если есть в url гет-параметры
            if (isset($url[1]) AND $url[1] != '') {
                //разбиваем гет-строку на отдельные части(гет-параметры)
                $params = explode('&', $url[1]);

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

                return '<nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center mb-4">' .$back . $next. '</ul>';
                `<li class="page-item"><a class="page-link" href="#">1</a></li>`;
        }
}
