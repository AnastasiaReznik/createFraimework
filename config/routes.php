<?php
use blog\Router;
// в самом начале надо писать КОНКРЕТНЫЕ, ПОЛЬЗОВАТЕЛЬСКИЕ ПРАВИЛА, т е не общие
Router::add('^post/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Post', 'action' => 'read']);
Router::add('^category/(?P<alias>[a-zA-Z0-9-]+)/?$', ['controller' => 'Category', 'action' => 'show']);

// Router::add('^search=.*$', ['controller' => 'Main', 'action' => 'search']);
// ?(.*)=.*

// ОБЩИЕ правила по умолчанию для маршрутов
//правила для админской части
Router::add('^admin$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'admin'] ); //
Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']); 

//правила для клиентской части
Router::add('^$', ['controller' => 'Main', 'action' => 'index']); //соответсвие с пустой строкой

Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$'); 