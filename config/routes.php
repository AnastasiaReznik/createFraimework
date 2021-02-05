<?php
use createFramework\Router;
// в самом начале надо писать КОНКРЕТНЫЕ, ПОЛЬЗОВАТЕЛЬСКИЕ ПРАВИЛА, т е не общие




// ОБЩИЕ правила по умолчанию для маршрутов 
//правила для админской части
Router::add('^admin$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'admin'] ); //
Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']); 

//правила для клиентской части
Router::add('^$', ['controller' => 'Main', 'action' => 'index']); //соответсвие с пустой строкой
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$'); 