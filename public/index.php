<?php
use \createFramework\App;
use \createFramework\Router;
require_once dirname(__DIR__) . '/config/init.php';
require_once LIBS . '/functions.php';
require_once CONF . '/routes.php';
// var_dump($_SERVER['QUERY_STRING']); //то что в url
$appObject = new App();
// debug(Router::getRoutes());
?>