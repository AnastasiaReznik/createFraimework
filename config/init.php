<?php
define("DEBUG", 1);
define("ROOT", dirname(__DIR__));
define("WWW", ROOT . '/public');
define("APP", ROOT . '/app');
define("CORE", ROOT . '/vender/blog/core');
define("LIBS", ROOT . '/vendor/blog/core/libs');
define("CACHE", ROOT . '/tmp/cache');
define("CONF", ROOT . '/config');
define("LAYOUT",'default');

//формируем строку адресной строки $_SERVER['HTTP_HOST'] - доменное имя blog,  $_SERVER['PHP_SELF'] -имя исполняемого скрипта от корневой папки /public/index.php ДО ГЕТ ПАРАМЕТРОВ
//http://blog/public/index.php
$app_path = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";
$app_path = preg_replace("#[^/]+$#", '', $app_path); //отрезали index.php
$app_path = str_replace('/public/', '', $app_path); //получили url главной страницы,  то есть доменное имя http://blog/

define("PATH",$app_path); //доменное имя
define("ADMIN",PATH . '/admin'); //путь к админке

require_once ROOT . '/vendor/autoload.php'; //подключили автозагрузчик


?>