<?php
namespace createFramework;

class App
{
    public static $app; //контейнер, в кот кладем свой-ва, объекты
    public function __construct()
    {
       $query = trim($_SERVER['QUERY_STRING'], '/'); //то что а адресной строке
       session_start();
    //    var_dump($query);
       self::$app = Registry::instance(); // в app записали объект класса реестр
       $this->getParams();
       new ErrorHandler();
       Router::dispatch($query);
    }

    //получить(подключить) файл с конфигурационными параметрами
    //и эти параметры записать в  контейнер Реестра
    protected function getParams()
    {
        $params = require_once CONF . '/params.php';
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                // self::$app->setProperty($key, $value);
                self::$app->setProperty($key, $value); //запись в Реестр
            }
        }
    }
}

?>