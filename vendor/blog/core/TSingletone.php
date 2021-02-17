<?php
namespace blog;

trait TSingletone
{
   private static $instance; //в нем будет хранится объект

   public static function instance()
   {
       if (self::$instance === null) {
           self::$instance = new self; //в инстансе запишется объект данного класса
       }
       return self::$instance;
   }
}
