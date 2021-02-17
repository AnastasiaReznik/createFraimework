<?php
namespace blog;
class Router
{
    protected static $routes = []; //все маршруты(адреса) на сайте
    protected static $route = []; //текущий маршрут в адресе, сюда будет записываться соответствие с тем что в адресной строке и в массиве

    // запись маршрутов в таблицу маршрутов(регуляр выраж и маршрут из url )
    public static function add($regexp, $route=[] ) {
        self::$routes[$regexp] = $route;
    }

    // возвращ табл маршрутов, для тестирования
    public static function getRoutes() {
        return self::$routes;
    }

    // возвращ текущий маршрут
    public static function getRoute() {
        return self::$route;
    }

    // метод, вызывает matchRoute() и в рез-ту либо вызывает соответствующий контроллер или ошибку 404
    public static function dispatch($url)
    {
        // debug($url);
        $url = self::removeQueryString($url);
        // var_dump($url);
        // если совпадение с таблицей маршрутов найдено
        if (self::matchRoute($url)) {
            // находим соответствующий контроллер
           $controller = 'app\controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';

           if (class_exists($controller)) {
               $controllerObject = new $controller(self::$route);
               $action = self::lowerCamelCase(self::$route['action'] . 'Action');

               if (method_exists($controllerObject, $action )) {
                   $controllerObject->$action();
                   $controllerObject->getView();

               } else {
                throw new \Exception("Метод $controller::$action не найден", 404);

               }
           } else {
            throw new \Exception("Контроллер $controller не найден", 404);
           }
        } else {
            throw new \Exception("Страница не найдена", 404);
            // echo 'NO';
        }
    }
    // метод для поиска соответствия в таблице маршрутов
    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#{$pattern}#", $url, $matches)) {
               foreach ($matches as $k => $val) {
                   if (is_string($k)) {
                       $route[$k] =$val; //запис в массив только строковые ключи controller  и action
                   }
               }
               if (empty($route['action'])) {
                   $route['action'] = 'index';
               }
               if (!isset($route['prefix'])) {
                $route['prefix'] = '';
               } else {
                $route['prefix'] .= '\\';
               }
               $route['controller'] = self::upperCamelCase($route['controller']);
               self::$route = $route;
            //    debug(self::$route);
               return true;
            }
        }
        return false;
    }

    //изменить наименова для контроллеров к виду MainController
    protected static function upperCamelCase($name)
    {
        return str_replace(' ','',ucwords(str_replace('-', ' ', $name))); //каждое слово с большой буквы
        // debug($name);
    }
    //изменить наименова для экшэнов к виду  indexAction
    protected static function lowerCamelCase($name)
    {
        return lcfirst(self::upperCamelCase($name));
    }

    protected static function removeQueryString($url)
    {
        if ($url) {
           $params = explode('&', $url, 2);
        //    debug($params);
           if (false === strpos($params[0], '=')) {
            //    debug($url);
               return rtrim($params[0], '/');
           } else {
            // debug($url);
               return '';
           }
        }
    }
}

