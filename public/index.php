<?php
use \blog\App;
use \blog\Router;
require_once dirname(__DIR__) . '/config/init.php';
require_once LIBS . '/functions.php';
require_once CONF . '/routes.php';
// var_dump($_SERVER['QUERY_STRING']); //то что в url
$appObject = new App();

// $appObject::$app->setProperty('my_pass', '343');
// debug($appObject::$app->getProperties());
// debug(Router::getRoutes());
// debug(Router::getRoute());
// preg_match("#^search=.*$#", 'search=each', $matches);
// debug($matches);
//^search=.*$
?>