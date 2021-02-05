<?php
namespace createFramework;

trait TSingletone
{
   private static $instance;
   public static function instance()
   {
       if (self::$instance === null) {
           self::$instance = new self; //в инстансе запишется объект данного класса
       }
       return self::$instance;
   } 
}
