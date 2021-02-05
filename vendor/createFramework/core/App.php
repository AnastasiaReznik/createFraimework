<?php 
namespace createFramework;

class App
{
    public static $app;
    public function __construct()
    {    
       $query = trim($_SERVER['QUERY_STRING'], '/'); //то что а адресной строке
       session_start();
    //    var_dump($query);
       self::$app = Registry::instance(); // в app теперь хранится объект реестра
       $this->getParams();
       new ErrorHandler();
       Router::dispatch($query);
    }

    protected function getParams()
    {
        $params = require_once CONF . '/params.php';
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                // self::$app->setProperty($key, $value);
                self::$app->setProperty($key, $value);
            }
        }
    }
}

?>