<?php
namespace createFramework;
class Registry
{
 use TSingletone;
 protected static $properties = []; //контейнер для свойств

//  записывает в контейнер св-во
public function setProperty($name, $value)
{
    self::$properties[$name] = $value;
}

//получает из контейнера свойство
public function getProperty($name)
{
    if (isset(self::$properties[$name])) {
        return self::$properties[$name];
    } else {
        return null;
    }
}

//распечатываает все доступные свойства в контейнере, для дебага
public function getProperties()
{
    return self::$properties;
}
}
